@extends('layouts.base')

@section('title', 'Add catalog')

@section('content')
  <form action="@if(!empty($catalog)){{ route('catalog.update-catalog', ['catalog' => $catalog]) }}@else{{ route('catalog.save-catalog') }}@endif" method="post" class="mt-5 col-md-6">
    @csrf
    @if(!empty($catalog)) @method('PATCH') @endif
    <div class="input-group mb-3">
      <span class="input-group-text">Title</span>
      <input
          type="text"
          name="title"
          class="form-control @error('title') is-invalid @enderror"
          required="required"
          value="{{ old('title', !empty($catalog) ? $catalog->title : '') }}"
      >
      @error('title')
      <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
      @enderror
    </div>

    @if(count($catalogs))
      <div class="input-group mb-5">
        <label class="input-group-text" for="parent_catalog">Parent</label>
        <select name="parent_id"  class="form-select" id="parent_catalog">
          @if (empty($catalog->parent_id))<option value="0" selected="">Choose...</option>@endif

          @foreach($catalogs as $key => $parent)
            <option value="{{ $parent->id }}" @if (!empty($catalog) && $catalog->parent_id == $parent->id) selected @endif>{{ $parent->title }}</option>
          @endforeach
        </select>
      </div>
    @else
      <div class="input-group mb-5">
        Catalogs not found
      </div>
    @endif

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('manage.stoke') }}" class="btn btn-link">Back</a>
  </form>
@endsection
