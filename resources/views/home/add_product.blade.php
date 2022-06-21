@extends('layouts.base')

@section('title', 'Add product')

@section('content')
  <form action="{{ route('home.save-product') }}" method="post" class="mt-5 col-md-6">
    @csrf
    <div class="input-group mb-3">
      <span class="input-group-text">Title</span>
      <input type="text" name="title" class="form-control" required="required">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Price</span>
      <input type="text" name="price" class="form-control" required="required">
    </div>

    @if(count($catalogs))
    <div class="input-group mb-5">
      <label class="input-group-text" for="product_catalog">Catalog</label>
      <select name="catalog_id"  class="form-select" id="product_catalog">
        <option selected="">Choose...</option>

        @foreach($catalogs as $key => $catalog)
        <option value="{{ $catalog->id }}">{{ $catalog->title_rus }}</option>
        @endforeach
      </select>
    </div>
    @else
      <div class="input-group mb-5">
        Catalogs not found
      </div>
    @endif

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('home.index') }}" class="btn btn-link">Back</a>
  </form>
@endsection
