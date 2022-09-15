<section>
  @if(count($catalogs))
    <table class="table mt-5 table-sm">
      <thead>
      <th>Title</th>
      <th>Products</th>
      @auth
        @if(Auth::user()->isAdmin())
          <th>actions</th>
        @endif
      @endauth
      </thead>
      <tbody>
      @foreach($catalogs as $key => $catalog)
        <tr>
          <td><a href="{{ route('catalog.show', ['catalog' => $catalog->id]) }}">{{ $catalog->getTitle() }}</a></td>
          <td>{{ $catalog->getAmountProducts() }}</td>
          @auth
            @if(Auth::user()->isAdmin())
              <td>
                <a href="{{ route('catalog.edit', ['catalog' => $catalog->id]) }}">Edit</a> /
                <a href="{{ route('catalog.delete', ['catalog' => $catalog->id]) }}">Remove</a>
              </td>
            @endif
          @endauth
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Catalogs not found
  @endif
</section>