<section>
  @if(count($products))
    <table class="table mt-5">
      <thead>
      <th>Title</th>
      <th>Price</th>
      </thead>
      <tbody>
      @foreach($products as $key => $product)
        <tr>
          <td><a href="{{ route('product.show', ['product' => $product->id]) }}">{{ $product->title }}</a></td>
          <td>{{ $product->price }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Products not found
  @endif
</section>