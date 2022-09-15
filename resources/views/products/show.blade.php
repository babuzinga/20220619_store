@extends('layouts/base')

@section('title', $product->getTitle())

@section('content')
  @includeIf('store/breadcrumb', ['breadcrumb' => $breadcrumb ?? []])

  <div class="row mt-4">
    <div class="col-sm-5 mb-4">
      <img src="{{ $product->getPreview() }}" alt="" class="img-thumbnail">
    </div>
    <div class="col-sm-7">
      {{--<h1>{{ $product->getTitle() }}</h1>--}}
      <div><span class="price-product">{{ $product->getPrice() }}</span></div>
      <div class="mt-3 desc2">{{ $product->getDesc() }}</div>
      <button type="button" class="btn btn-danger mt-4">В корзину</button>
    </div>
  </div>
@endsection('main')
