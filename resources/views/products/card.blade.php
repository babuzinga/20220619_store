<div class="col">
  <div class="card">
    <img src="{{ $product->getPreview() }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><a href="{{ route('product.show', ['product' => $product->id]) }}">{{ $product->getTitle() }}</a></h5>
      <p class="card-text desc2">{{ $product->getDesc() }}</p>
      <span>{{ $product->getPrice() }}</span>
      <br>
      <button type="button" class="btn btn-danger mt-4 in-cart" data-product="{{ $product->id }}">В корзину</button>

      @auth
        @if(Auth::user()->isAdmin())
          <div class="mt-3 text-end">
            <a href="{{ route('product.edit', ['product' => $product->id]) }}">Edit</a> /
            <a href="{{ route('product.delete', ['product' => $product->id]) }}">Remove</a>
          </div>
        @endif
      @endauth
    </div>
  </div>
</div>
