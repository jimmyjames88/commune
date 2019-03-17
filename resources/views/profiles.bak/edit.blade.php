@extends('layouts.app')

@section('content')
    <form action="/profiles/{{ $user->id }}" method="POST">
        @csrf
        {{ method_field('put') }}
        <div class="form-group">
            <label>Location</label>
            <input class="form-control" type="text" name="location" value="{{ $user->profile->location }}" />
        </div>
        <div class="form-group">
            <label>Birthday</label>
            <input class="form-control" type="date" name="birthday" value="{{ $user->profile->birthday }}" />
        </div>
        <!-- <div class="form-group">
            <label>Avatar</label>
            <input type="text" name="avatar" value="{{ $user->profile->avatar }}" />
        </div> -->
        <div class="form-group">
            <label>Website</label>
            <input class="form-control" type="text" name="website" value="{{ $user->profile->website }}" />
        </div>
        <div class="form-group">
            <label>Bio</label>
            <textarea class="form-control" name="bio">{{ $user->profile->bio }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
