@extends('layouts.base')

@section('title', 'Главная')

@section('content')
  <section>
    <a href="{{ route('catalog.index') }}">Каталоги</a>
  </section>

  <h4 class="pb-2 border-bottom mt-5">Новинки</h4>
  @includeIf('products/list_cards', ['products' => $products_new])

  <h4 class="pb-2 border-bottom mt-5">В топе</h4>
  @includeIf('products/list_cards', ['products' => $products_top])

  <h4 class="pb-2 border-bottom mt-5">Распродажа</h4>
  @includeIf('products/list_cards', ['products' => $products_discount])
@endsection