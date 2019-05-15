@extends('layouts.app')

@section('title', 'Welcome to the shit')

@section('content')

    @include('posts._create')

    @foreach ($posts as $post)
        @include('posts._post')
    @endforeach
    {{ $posts->links() }}
@endsection
