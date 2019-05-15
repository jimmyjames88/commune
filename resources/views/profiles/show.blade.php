@extends('layouts.app')

@section('sidebar-left')
<div class="card">
    <div class="card-body text-center">
        @if($user->profile->avatar)
        <div class="img-thumbnail rounded profile-photo" style="background-image:url('{{ Storage::disk('s3')->url('/avatars/' . $user->profile->user_id . '/' . $user->profile->avatar) }}')"></div>
        @else
        <div class="img-thumbnail rounded profile-photo" style="background-image:url('/images/avatars/default.png')"></div>
        @endif
        <h3 class="card-title mt-2">{{ $user->name }}</h3>
        @if(Auth::id() == $user->id)
        <a href="/profiles/{{ $user->id }}/edit" class="btn btn-small btn-primary">
            <i class="fa fa-pencil"></i> Edit Profile
        </a>
        @endif
    </div>
    <div class="card-body d-flex row justify-content-between text-center">
        <a href="/profiles/{{ $user->id }}/followers" class="col">
            <h3>{{ $user->followers->count() }}</h3>
            <span>Followers</span>
        </a>
        <a href="/profiles/{{ $user->id }}/following" class="col">
            <h3>{{ $user->following->count() }}</h3>
            <span>Following</span>
        </a>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                <i class="fa fa-globe"></i>
                <a href="{{ $user->profile->website }}" target="_blank">
                    Website
                </a>
            </li>
            <li class="list-group-item">
                <i class="fa fa-map-marker"></i> {{ $user->profile->location }}
            </li>
            <li class="list-group-item">
                <i class="fa fa-birthday-cake"></i> {{ $user->profile->birthday }}
            </li>
            <li class="list-group-item">
                <i class="fa fa-book"></i> {{ $user->profile->bio }}
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')

@if(auth()->id() == $user->id)
@include('posts._create')
@endif

@foreach($user->posts as $post)
    @include('posts._post')
@endforeach

@endsection
