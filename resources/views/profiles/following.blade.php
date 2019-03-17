@extends('layouts.app')

@section('content')
<h1 class="title">Following ({{ $user->following->count() }})</h1>
    @foreach($user->following as $user)
        @include('profiles._followee')
    @endforeach
@endsection
