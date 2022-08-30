@extends('layouts.base')

@section('title', 'Home')

@section('content')
  <div class="row justify-content-center mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Data') }}</div>

        <div class="card-body">




          <br>
          <a href="{{ route('home.update-info') }}" type="button" class="btn btn-primary mt-3">Update</a>
        </div>
      </div>
    </div>
  </div>
@endsection
