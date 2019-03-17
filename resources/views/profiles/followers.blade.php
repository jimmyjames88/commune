@extends('layouts.app')

@section('content')
<h1 class="title">Follower {{ $user->followers->count() }}</h1>
    @foreach($user->followers as $user)
        @include('profiles._followee')
    @endforeach
@endsection
