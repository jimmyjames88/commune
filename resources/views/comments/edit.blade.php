@extends('layouts.app')

@section('content')
<h1 class="title">Edit Comment</h1>
<div class="card mt-4">
    <div class="card-body">
        <form class="form-inline" action="/posts/{{ $post->id }}/comments/ {{ $comment->id }}" method="POST">
            @csrf
            {{ method_field('put') }}
            <div class="form-group col-10">
                <input type="text" name="body" class="form-control w-100" value="{{ $comment->body }}" />
            </div>
            <div class="form-group col-2">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
