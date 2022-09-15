<div class="col">
  <div class="card">
    <img src="{{ $product->getPreview() }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><a href="{{ route('product.show', ['product' => $product->id]) }}">{{ $product->getTitle() }}</a></h5>
      <p class="card-text">{{ $product->getDesc() }}</p>
      <span>{{ $product->getPrice() }}</span>

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
