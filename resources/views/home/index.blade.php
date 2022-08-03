@extends('layouts.base')

@section('title', 'Home')

@section('content')
  <div class="row justify-content-center mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Products') }}</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

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
                    <a href="{{ route('home.edit-product', ['product' => $product->id]) }}">Edit</a> /
                    <a href="{{ route('home.delete-product', ['product' => $product->id]) }}">Remove</a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          @else
            Products not found
          @endif

          <br>
          <a href="{{ route('home.add-product') }}" type="button" class="btn btn-primary mt-3">Add product</a>
        </div>
      </div>
    </div>
  </div>
@endsection
