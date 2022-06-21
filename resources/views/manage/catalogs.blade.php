@extends('layouts/base')

@section('title', 'Catalogs')

@section('content')
  @if(count($catalogs))
    <table class="table mt-5">
      <thead>
      <th>ID</th>
      <th>Title eng</th>
      <th>Title rus</th>
      <th>Actions</th>
      </thead>
      <tbody>
      @foreach($catalogs as $key => $catalog)
        <tr>
          <td>{{ $catalog->id }}</td>
          <td>{{ $catalog->title_eng }}</td>
          <td>{{ $catalog->title_rus }}</td>
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
