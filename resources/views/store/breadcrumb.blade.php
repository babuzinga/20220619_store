<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Главная</a></li>

    @if(!empty($breadcrumb))
      @foreach($breadcrumb as $item)
        @if(!empty($item['link']))
          <li class="breadcrumb-item"><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
        @else
          <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
        @endif
      @endforeach
    @endif
  </ol>
</nav>
