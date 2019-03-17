<article class="card mb-4" id="{{ 'p' . $post->id }}">
    <div class="card-body">
        <a href="/profiles/{{ $post->user->id }}" class="img-thumbnail float-left mr-2" style="width: 64px; height: 64px;"></a>
        <div style="height: 80px;">
            <h4 class="card-title">{{ $post->user->name }}</h4>
            <h5 class="card-subtitle text-muted">{{ $post->created_at }}</h5>
        </div>
        <p class="card-text">{{ $post->body }}</p>
        <div class="card-text">
            <a href="/likes/{{ $post->id }}/post">{{ $post->liked_by_user ? 'Unlike' : 'Like' }} ({{ $post->likes->count() }})</a> -
            <a href="/posts/{{ $post->id }}#comments">Comments ({{ $post->comments->count() }})</a>
            @if($post->belongs_to_user)
             - <a href="/posts/{{ $post->id }}/delete">Delete</a>
            @endif
        </div>

    </div>
</article>
