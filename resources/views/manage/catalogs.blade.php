@extends('layouts/base')

@section('title', 'Catalogs')

@section('content')
  @if(count($catalogs))
    <table class="table mt-5">
      <thead>
      <th>Title</th>
      <th>Products</th>
      <th>Actions</th>
      </thead>
      <tbody>
      @foreach($catalogs as $key => $catalog)
        <tr>
          <td>{{ $catalog->title }}</td>
          <td>0</td>
          <td>
            <a href="{{ route('manage.edit-catalog', ['catalog' => $catalog->id]) }}">Edit</a> /
            <a href="{{ route('manage.delete-catalog', ['catalog' => $catalog->id]) }}">Remove</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    Catalogs not found
  @endif

  <br>
  <a href="{{ route('manage.add-catalog') }}" type="button" class="btn btn-primary mt-3">Add catalog</a>
@endsection('main')
