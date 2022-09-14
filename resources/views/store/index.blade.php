@extends('layouts.base')

@section('title', 'Главная')

@section('content')
  <a href="{{ route('catalog.index') }}">Каталоги</a>
@endsection