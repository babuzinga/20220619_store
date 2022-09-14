<section class="mb-5">
  @if(count($catalogs))
    <table class="table mt-5">
      <thead>
      <th>Title</th>
      <th>Products</th>
      </thead>
      <tbody>
      @foreach($catalogs as $key => $catalog)
        <tr>
          <td><a href="{{ route('catalog.show', ['catalog' => $catalog->id]) }}">{{ $catalog->title }}</a></td>
          <td>{{ $catalog->products_amount }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Catalogs not found
  @endif
</section>