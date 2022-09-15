<section>
  @if(count($products))
    <table class="table mt-5 table-sm">
      <thead>
        <th>Title</th>
        <th>Price</th>
        <th>Catalog</th>
        <th>Amount</th>
        @auth
          @if(Auth::user()->isAdmin())
            <th>actions</th>
          @endif
        @endauth
      </thead>
      <tbody>
      @foreach($products as $key => $product)
        <tr>
          <td><a href="{{ route('product.show', ['product' => $product->id]) }}">{{ $product->title }}</a></td>
          <td>{{ $product->getPrice() }}</td>
          <td>
            @if(!empty($product->catalog))
              <a href="{{ route('catalog.index', ['catalog' => $product->catalog->id]) }}">{{ $product->catalog->title }}</a>
            @else
              -
            @endif
          </td>
          <td>{{ $product->getAmount() }}</td>
          @auth
            @if(Auth::user()->isAdmin())
            <td>
              <a href="{{ route('product.edit', ['product' => $product->id]) }}">Edit</a> /
              <a href="{{ route('product.delete', ['product' => $product->id]) }}">Remove</a>
            </td>
            @endif
          @endauth
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Products not found
  @endif
</section>