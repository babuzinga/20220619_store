@extends('layouts.base')

@section('title', 'Stoke')

@section('content')
  @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  @if(count($catalogs))
    <table class="table mt-5">
      <thead>
      <th>Title</th>
      <th>Products</th>
      <th>Actions</th>
      </thead>
      <tbody>
      @foreach($catalogs as $key => $catalog)
        <tr>
          <td>{{ $catalog->title }}</td>
          <td>0</td>
          <td>
            <a href="{{ route('catalog.edit-catalog', ['catalog' => $catalog->id]) }}">Edit</a> /
            <a href="{{ route('catalog.delete-catalog', ['catalog' => $catalog->id]) }}">Remove</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    <br>Catalogs not found<br>
  @endif


  <a href="{{ route('catalog.add-catalog') }}" type="button" class="btn btn-primary mt-3 mb-5">Add catalog</a>



  @if(count($products))
    <table class="table">
      <thead>
      <th>Title</th>
      <th>Price</th>
      <th>Catalog</th>
      <th>Actions</th>
      </thead>
      <tbody>
      @foreach($products as $key => $product)
        <tr>
          <td><a href="{{ route('product.detail', ['product' => $product->id]) }}">{{ $product->title }}</a></td>
          <td>{{ $product->price }}</td>
          <td>
            @if(!empty($product->catalog))
              <a href="{{ route('product.catalog', ['catalog' => $product->catalog->id]) }}">{{ $product->catalog->title }}</a>
            @else
              -
            @endif
          </td>
          <td>
            <a href="{{ route('product.edit-product', ['product' => $product->id]) }}">Edit</a> /
            <a href="{{ route('product.delete-product', ['product' => $product->id]) }}">Remove</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    <br>Products not found<br>
  @endif

  <a href="{{ route('product.add-product') }}" type="button" class="btn btn-primary mt-3 mb-5">Add product</a>
@endsection('main')
