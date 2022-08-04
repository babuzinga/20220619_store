@extends('layouts/base')

@section('title', $title)

@section('content')
  @if(count($products))
    <table class="table mt-5">
      <thead>
      <th>Title</th>
      <th>Price</th>
      </thead>
      <tbody>
      @foreach($products as $key => $product)
        <tr>
          <td><a href="{{ route('product.detail', ['product' => $product->id]) }}">{{ $product->title }}</a></td>
          <td>{{ $product->price }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Products not found
  @endif
@endsection('main')
