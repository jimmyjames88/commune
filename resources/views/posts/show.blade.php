@extends('layouts.app')

@section('content')
    @include('posts._post')

    <h3 class="title" id="comments">Comments ({{ $post->comments->count() }})</h3>
    @foreach($post->comments as $comment)
    @include('comments._comment')
    @endforeach

    @include('comments._create')
@endsection
