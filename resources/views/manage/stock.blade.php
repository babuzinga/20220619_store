@extends('layouts.base')

@section('title', 'Stoke')

@section('content')
  @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  @includeIf('catalogs/list_table', ['catalogs' => $catalogs])
  <a href="{{ route('catalog.create') }}" type="button" class="btn btn-primary mt-3">Add catalog</a>

  @includeIf('products/list_table', ['catalogs' => $catalogs])
  <a href="{{ route('product.create') }}" type="button" class="btn btn-primary mt-3 mb-5">Add product</a>
@endsection('main')
