<section>
  @if(count($products))
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
      @each('products/card', $products, 'product')
    </div>

  @else
    Products not found
  @endif
</section>