@extends('layouts.base')

@section('title', $title)

@section('content')
  <form action="@if(!empty($product)){{ route('home.update-product', ['product' => $product]) }}@else{{ route('home.save-product') }}@endif" method="post" class="mt-5 col-md-6">
    @csrf
    @if(!empty($product)) @method('PATCH') @endif
    <div class="input-group mb-3">
      <span class="input-group-text">Title</span>
      <input
          type="text"
          name="title"
          class="form-control @error('title') is-invalid @enderror"
          required="required"
          value="{{ old('title', !empty($product) ? $product->title : '') }}"
      >
      @error('title')
      <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
      @enderror
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Price</span>
      <input
          type="text"
          name="price"
          class="form-control @error('price') is-invalid @enderror"
          required="required"
          value="{{ old('price', !empty($product) ? $product->price : '') }}"
      >
      @error('price')
      <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
      @enderror
    </div>

    @if(count($catalogs))
      <div class="input-group mb-5">
        <label class="input-group-text" for="product_catalog">Catalog</label>
        <select name="catalog_id" class="form-select" id="product_catalog">
          @if (empty($product) || empty($product->catalog_id))<option value="" selected="">Choose...</option>@endif

          @foreach($catalogs as $key => $catalog)
            <option value="{{ $catalog->id }}" @if (!empty($product) && $product->catalog_id == $catalog->id) selected @endif>{{ $catalog->title }}</option>
          @endforeach
        </select>
        @error('catalog_id')
        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
      </div>
    @else
      <div class="input-group mb-5">
        Catalogs not found
      </div>
    @endif

    <button type="submit" class="btn btn-success">@if(!empty($product)) Update @else Save @endif</button>
    <a href="{{ route('home.index') }}" class="btn btn-link">Back</a>
  </form>
@endsection
