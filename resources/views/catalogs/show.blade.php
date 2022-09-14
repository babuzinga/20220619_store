@extends('layouts.base')

@section('title', $title)

@section('content')
  @includeIf('store/breadcrumb', ['breadcrumb' => $breadcrumb ?? []])

  @includeIf('catalogs/list', ['catalogs' => $catalogs])

  @includeIf('products/list', ['products' => $products])
@endsection('main')
