@extends('layout')

@section('title', 'Homepage')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{asset('.css/index.css')}}">
    @endpush

@endsection
