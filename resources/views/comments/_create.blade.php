<div class="card mt-4 comment-create">
    <div class="card-body">
        <comment :postid="{{ $post->id }}">
            @csrf
            @include('profiles._avatar_thumbnail', ['user' => $post->user])
        </comment>
    </div>
</div>
