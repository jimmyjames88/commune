<ul class="list-group mt-2">
    @foreach($comments as $comment)
    <div class="list-group-item comment-preview">
        <strong>{{ $comment->user->name }}</strong> {{ substr($comment->body, 0, 40) }}...
    </div>
    @endforeach
    <a href="/posts/{{ $post->id }}#comments" class="list-group-item text-center">
        View all comments
    </a>
</ul>
