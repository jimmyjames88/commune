@extends('layouts.app')

@section('content')
<h1 class="title">Edit Profile</h1>
<form action="/profiles/{{ $profile->user_id }}" method="post">
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
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection
