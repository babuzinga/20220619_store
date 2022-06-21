@extends('layouts/base')

@section('title', 'Products')

@section('content')
  @if(count($products))
    <table class="table mt-5">
      <thead>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Owner</th>
      </thead>
      <tbody>
      @foreach($products as $key => $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td><a href="{{ route('product.detail', ['product' => $product->id]) }}">{{ $product->title }}</a></td>
        <td>{{ $product->price }}</td>
        <td><a href="{{ route('product.users', ['user' => $product->user->id]) }}">{{ $product->user->name }}</a></td>
      </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Products not found
  @endif
@endsection('main')
