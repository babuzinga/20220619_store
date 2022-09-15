@extends('layouts.base')

@section('title', $title)

@section('content')
  @includeIf('store/breadcrumb', ['breadcrumb' => $breadcrumb ?? []])

  @includeIf('catalogs/list_table', ['catalogs' => $catalogs])

  <h4 class="pb-2 border-bottom mt-5">Products</h4>

  @auth
    @if(Auth::user()->isAdmin())
      <a href="{{ route('product.create') }}{{ !empty($catalog) ? '?cid=' . $catalog->id : '' }}" type="button" class="btn btn-primary mt-3 mb-5">Add product</a>
    @endif
  @endauth

  @includeIf('products/list_cards', ['products' => $products])
@endsection('main')
