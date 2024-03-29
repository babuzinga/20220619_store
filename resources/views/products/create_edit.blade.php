@extends('layouts.base')

@section('title', $title)

@section('content')
  <div class="row">
    <div class="mt-5 col-md-6">
      <form action="@if(!empty($product)){{ route('product.update', ['product' => $product]) }}@else{{ route('product.store') }}@endif" method="post">
        @csrf
        @if(!empty($product)) @method('PATCH') @endif

        <div class="mb-3">
          <label for="inputTitle" class="form-label">Title</label>
          <input
              id="inputTitle"
              type="text"
              name="title"
              class="form-control @error('title') is-invalid @enderror"
              required="required"
              value="{{ old('title', !empty($product) ? $product->title : '') }}"
          >
          @error('title')
          <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="inputDesc" class="form-label">Desc</label>
          <textarea
              id="inputDesc"
              class="form-control"
              name="desc"
              rows="3"
          >{{ old('desc', !empty($product) ? $product->desc : '') }}</textarea>
        </div>

        <div class="mb-3">
          <label for="inputPrice" class="form-label">Price</label>
          <input
              id="inputPrice"
              type="text"
              name="price"
              class="form-control @error('price') is-invalid @enderror"
              required="required"
              value="{{ old('price', !empty($product) ? $product->price : '') }}"
              placeholder="100,00"
          >
          @error('price')
          <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="inputDiscount" class="form-label">Discount</label>
          <input
              id="inputDiscount"
              type="text"
              name="discount"
              class="form-control @error('discount') is-invalid @enderror"
              required="required"
              value="{{ old('price', !empty($product) ? $product->discount : '0') }}"
              placeholder="100,00"
          >
          @error('discount')
          <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        @if(count($catalogs))
          <div class="mb-3">
            <label for="inputCatalog" class="form-label">Catalog</label>
            <select name="catalog_id" class="form-select" id="inputCatalog">
              @if ((empty($product) || empty($product->catalog_id)) && empty($_GET['cid']))<option value="" selected="">Choose...</option>@endif

              @foreach($catalogs as $key => $catalog)
                <option
                    value="{{ $catalog->id }}"
                    @if (
                      (!empty($product) && $product->catalog_id == $catalog->id) ||
                      (empty($product) && !empty($_GET['cid']) && $_GET['cid'] == $catalog->id)
                    ) selected @endif
                >{{ $catalog->getTitle() }}</option>
              @endforeach
            </select>
            @error('catalog_id')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        @else
          <div class="mb-3">
            Catalogs not found
          </div>
        @endif

        <div class="mb-3">
          <label for="inputAmount" class="form-label">Product amount</label>
          <input
              id="inputAmount"
              type="text"
              name="amount"
              class="form-control @error('amount') is-invalid @enderror"
              required="required"
              value="{{ old('amount', !empty($product) ? $product->amount : '1') }}"
              placeholder="1"
          >
          @error('amount')
          <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <button type="submit" class="btn btn-success">@if(!empty($product)) Update @else Save @endif</button>
        <a href="{{ route('manage.stoke') }}" class="btn btn-link">Back</a>
      </form>
    </div>

    <div class="mt-5 col-md-6">
      @if(!empty($product))
      <form action="{{ route('product.upload-file', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
        @csrf

        Images
        <div id="preview_images_products" class="mt-3 mb-3">-</div>

        Upload
        <div id="upload_images_products" class="mt-3"></div>

        <div class="input-group mb-5">
          <input type="file" name="file" class="form-control" accept="image/*" multiple id="inputImageProduct">
        </div>
        @error('file')
        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror

        <button type="submit" class="btn btn-success">Upload</button>
      </form>
      @endif
    </div>
  </div>
@endsection
