<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Главная</a></li>

    @if(!empty($breadcrumb))
      @foreach($breadcrumb as $item)
      <li class="breadcrumb-item"><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
      @endforeach
    @endif
    <li class="breadcrumb-item active" aria-current="page">Товар</li>
  </ol>
</nav>
