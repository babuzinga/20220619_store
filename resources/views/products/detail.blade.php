@extends('layouts/base')

@section('title', $product->getTitle())

@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Главная</a></li>
      @if(!empty($product->catalog))
        <li class="breadcrumb-item"><a href="{{ route('catalog.index', ['catalog' => $product->catalog->id]) }}">{{ $product->catalog->title }}</a></li>
      @endif
      <li class="breadcrumb-item active" aria-current="page">Товар</li>
    </ol>
  </nav>

  <div class="row mt-4">
    <div class="col-sm-5 mb-4">
      <img src="{{ $product->getPreview() }}" alt="" class="img-thumbnail">
    </div>
    <div class="col-sm-7">
      {{--<h1>{{ $product->getTitle() }}</h1>--}}
      <div><span class="price-product">{{ $product->getPrice() }} &#8381;</span></div>
      <div class="mt-3">{{ $product->getDesc() }}</div>
      <button type="button" class="btn btn-danger mt-4">В корзину</button>
    </div>
  </div>
@endsection('main')
