@extends('layouts/base')

@section('title', 'Products')

@section('main')
  @if(count($products))
    <table>
      <thead>
        <th>ID</th>
        <th>Title</th>
      </thead>
      <tbody>
      @foreach($products as $key =>$product)
      <tr>
        <td>{{ $product->id }}</td>
        <td><a href="{{ route('product.detail', ['product' => $product->id]) }}">{{ $product->title }}</a></td>
      </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Products not found
  @endif
@endsection('main')
