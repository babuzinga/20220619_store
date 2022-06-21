@extends('layouts.base')

@section('title', 'Edit product')

@section('content')
  <form action="{{ route('home.update-product', ['product' => $product]) }}" method="post" class="mt-5 col-md-6">
    @csrf
    @method('PATCH')
    <div class="input-group mb-3">
      <span class="input-group-text">Title</span>
      <input type="text" name="title" class="form-control" required="required" value="{{ $product->title }}">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Price</span>
      <input type="text" name="price" class="form-control" required="required" value="{{ $product->price }}">
    </div>

    <div class="input-group mb-5">
      <label class="input-group-text" for="inputGroupSelect01">Catalog</label>
      <select name="catalog_id"  class="form-select" id="product_catalog">
        {{--<option selected="">Choose...</option>--}}
        <option value="100000"@if ($product->catalog_id == 100000) selected @endif>Badges</option>
        <option value="100001"@if ($product->catalog_id == 100001) selected @endif>Bags</option>
        <option value="100002"@if ($product->catalog_id == 100002) selected @endif>Key-chains</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('home.index') }}" class="btn btn-link">Back</a>
  </form>
@endsection
