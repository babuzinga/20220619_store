@extends('layouts.base')

@section('title', 'Add catalog')

@section('content')
  <form action="{{ route('manage.save-catalog') }}" method="post" class="mt-5 col-md-6">
    @csrf
    <div class="input-group mb-3">
      <span class="input-group-text">Title eng</span>
      <input type="text" name="title_eng" class="form-control" required="required">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Title rus</span>
      <input type="text" name="title_rus" class="form-control" required="required">
    </div>

    @if(count($catalogs))
      <div class="input-group mb-5">
        <label class="input-group-text" for="parent_catalog">Parent</label>
        <select name="parent_id"  class="form-select" id="parent_catalog">
          <option value="0" selected="">Choose...</option>

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
    <a href="{{ route('product.index') }}" class="btn btn-link">Back</a>
  </form>
@endsection
