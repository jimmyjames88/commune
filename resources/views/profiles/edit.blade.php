@extends('layouts.app')

@section('content')
<h1 class="title">Edit Profile</h1>
<form action="/profiles/{{ $profile->user_id }}" method="post" enctype="multipart/form-data">
    {{ method_field('put') }}
    @csrf
    <div class="form-group">
        <label>Location</label>
        <input type="text" name="location" class="form-control" value="{{ $profile->location }}" />
    </div>
    <div class="form-group">
        <label>Birthday</label>
        <input type="date" name="birthday" class="form-control" value="{{ $profile->birthday }}" />
    </div>
    <div class="form-group">
        <label>Website</label>
        <input type="text" name="website" class="form-control" value="{{ $profile->website }}" />
    </div>
    <div class="form-group">
        <label>Bio</label>
        <textarea name="bio" class="form-control">{{ $profile->bio }}</textarea>
    </div>
    <div class="form-group">
        <label>Profile Photo</label>
        <photo-upload
            :name="'avatar'"
            photo="{{ $profile->avatar ? '/images/avatars/' . $profile->user->id . '/' . $profile->avatar : ''}}">
        </photo-upload>
    </div>
    <div class="form-group">
        @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection
