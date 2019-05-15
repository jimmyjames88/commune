@extends('layouts.app')

@section('content')
@if(Auth::id() == $user->id)
<a class="btn btn-primary" href="/profiles/{{ $user->id }}/edit">Edit Profile</a>
@endif
<h1 class="title">{{ $user->name }}</h1>
<p>{{ $user->profile->bio }}</p>

<img src="/images/avatars/{{ $user->profile->avatar }}" />

<ul class="list-group mb-4">
    <li class="list-group-item">Location: {{ $user->profile->location }}</li>
    <li class="list-group-item">Birthday: {{ $user->profile->birthday }}</li>
    <li class="list-group-item">
        Website: <a href="{{ $user->profile->website }}">{{ $user->profile->website }}</a>
    </li>
</ul>

@foreach($posts as $post)
@include('posts._post')
@endforeach
@endsection
