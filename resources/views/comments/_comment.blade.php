<div class="list-group-item">
    <a href="/profiles/{{ $comment->user->id }}" class="rounded img-thumbnail float-left mr-2" style="width:48px; height:48px;"></a>
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->body }}</p>
    <p>
        <a href="/likes/{{ $comment->id }}/comment">
            {{ ($comment->liked_by_user ? 'Unlike' : 'Like') }}
            ({{ $comment->likes->count() }})
        </a>
        @if($comment->belongs_to_user)
        - <a href="/posts/{{ $post->id }}/comments/{{ $comment->id }}/edit">Edit</a> 
        - <a href="/posts/{{ $post->id }}/comments/{{ $comment->id }}/delete">Delete</a>
        @endif
    </p>
</div>
