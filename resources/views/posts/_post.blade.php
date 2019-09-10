<article class="post card mb-4 p-4" id="{{ 'p' . $post->id }}">
    <div>
        @include('profiles._avatar_thumbnail', ['user' => $post->user])
        <h3>{{ $post->user->name }}</h3>
        <em>{{ $post->created_at->diffForHumans() }}</em>
    </div>
</article>
