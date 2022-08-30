@extends('layouts.base')

@section('title', 'Delete catalog')

@section('content')
  <form action="{{ route('catalog.destroy-catalog', ['catalog' => $catalog]) }}" method="post" class="mt-5 col-md-6">
    @csrf
    @method('DELETE')
    <div class="alert alert-danger mb-5">Are you sure you want to delete?</div>

    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="{{ route('manage.stoke') }}" class="btn btn-link">Back</a>
  </form>
@endsection
