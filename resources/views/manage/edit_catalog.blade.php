@extends('layouts.base')

@section('title', 'Edit catalog')

@section('content')
  <form action="{{ route('manage.update-catalog', ['catalog' => $catalog]) }}" method="post" class="mt-5 col-md-6">
    @csrf
    @method('PATCH')
    <div class="input-group mb-3">
      <span class="input-group-text">Title</span>
      <input type="text" name="title_eng" class="form-control" required="required" value="{{ $catalog->title_eng }}">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Price</span>
      <input type="text" name="title_rus" class="form-control" required="required" value="{{ $catalog->title_rus }}">
    </div>

    @if(count($catalogs))
      <div class="input-group mb-5">
        <label class="input-group-text" for="product_catalog">Catalog</label>
        <select name="catalog_id"  class="form-select" id="product_catalog">
          @if (empty($catalog->parent_id))<option selected="">Choose...</option>@endif

          @foreach($catalogs as $key => $parent)
            <option value="{{ $parent->id }}" @if ($catalog->parent_id == $parent->id) selected @endif>{{ $parent->title_rus }}</option>
          @endforeach
        </select>
      </div>
    @else
      <div class="input-group mb-5">
        Catalogs not found
      </div>
    @endif

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('home.index') }}" class="btn btn-link">Back</a>
  </form>
@endsection
