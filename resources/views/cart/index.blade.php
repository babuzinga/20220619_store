@extends('layouts.base')

@section('title', 'Корзина')

@section('content')
  <section>
    @if(count($products))
      <table class="table mt-5 table-sm">
        <thead>
          <th>Товар</th>
          <th>Цена</th>
          <th>Количество</th>
          <th>Итого</th>
          <th></th>
        </thead>
        <tbody>
        @foreach($products as $item)
          <tr>
            <td><a href="{{ route('product.show', ['product' => $item['product']->id]) }}">{{ $item['product']->getTitle() }}</a></td>
            <td>{{ $item['product']->getPrice() }}</td>
            <td>{{ $item['cnt'] }}</td>
            <td>{{ $item['end'] }}</td>
            <td>Удалить</td>
          </tr>
        @endforeach
        <tfoot>
          <th></th>
          <th></th>
          <th>{{ $total_quantity }}</th>
          <th>{{ $total_amount }}</th>
          <th></th>
        </tfoot>
        </tbody>
      </table>

      <a href="{{ route('cart.clear') }}">Очистить корзину</a>
    @else
      Корзина пуста
    @endif
  </section>
@endsection