<div class="list-group-item comment mb-1">
    @include('profiles._avatar_thumbnail', ['user' => $comment->user])
    <h5 class="font-weight-bold">
        <a href="/profiles/{{ $comment->user->id }}">
            {{ $comment->user->name }}
        </a>
    </h5>
    <em>{{ $comment->created_at->diffForHumans() }}</em>
    <p>{{ $comment->body }}</p>
    @if($comment->photo)
    <div class="card">
        <div class="card-body">
            <img class="img-fluid" src="/images/posts/{{ $post->id }}/comments/{{ $comment->photo }}" />
        </div>
    </div>
    @endif
    <div class="comment-buttons">
        <like-button
                :id="{{ $comment->id }}"
                :type="'comment'"
                :count="{{ $comment->likes()->count() }}"
                :liked="{{ $comment->liked_by_user ? 1 : 0 }}">
        </like-button>
        @if($comment->belongs_to_user)
        <a href="/posts/{{ $post->id }}/comments/{{ $comment->id }}/edit">Edit</a>
        <a href="/posts/{{ $post->id }}/comments/{{ $comment->id }}/delete">Delete</a>
        @endif
    </div>
</div>