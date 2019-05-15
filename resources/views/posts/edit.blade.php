@extends('layouts.app')
@section('content')
<div class="card bg-light mb-4">
    <div class="card-header">
        Write a Post
    </div>
    <div class="card-body">
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('put') }}
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="What's on your mind?">{{ $post->body }}</textarea>
            </div>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form-group row mb-0">
                <div class="col-6">
                    <a href="#addPhotoPane" data-toggle="collapse">
                        <i class="fa fa-camera"></i> Photo
                    </a>
                    <div id="addPhotoPane" class="{{ is_null($post->photo) ? 'collapse' : 'show collapse' }}">
                        <photo-upload
                            :name="'photo'"
                            photo="{{ !is_null($post->photo) ? '/images/posts/' . $post->id . '/' . $post->photo : '' }}">
                        </photo-upload>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <button type="submit" class="btn btn-primary">Publish</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
