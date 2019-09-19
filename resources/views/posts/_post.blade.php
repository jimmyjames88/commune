<article class="post card mb-4" id="{{ 'p' . $post->id }}">
    <div class="card-body">
        @include('profiles._avatar_thumbnail', ['user' => $post->user])
        <div style="height: 80px;">
            <h4 class="card-title font-weight-bold">
                <a href="/profiles/{{ $post->user->id }}">
                    {{ $post->user->name }}
                </a>
            </h4>
            <h5 class="card-subtitle text-muted">{{ $post->created_at->diffForHumans() }}</h5>
        </div>
        <p class="card-text">{{ $post->body }}</p>

        @if($post->photo)
        <div class="card post-photo">
            <a
                href="/images/posts/{{ $post->id }}/{{ $post->photo }}"
                class="card-body img-thumbnail"
                data-lightbox="{{ $post->id }}"
                style="background-image:url(/images/posts/{{ $post->id }}/{{ $post->photo }});">
                <div class="overlay">
                    <i class="fa fa-search"></i>
                </div>
            </a>
        </div>
        @endif
        <hr />
        <div class="card-text post-buttons">
            <like-button :post-id="{{ $post->id }}" is-liked="{{ $post->likedByUser }}" :count="{{ $post->likes()->count() }}"></like-button>
            <a href="/posts/{{ $post->id }}#comments">
                <i class="fa fa-comment-o"></i> Comments ({{ $post->comments->count() }})
            </a>
            @if($post->belongs_to_user)
            <a href="/posts/{{ $post->id }}/edit">Edit</a>
            <a href="/posts/{{ $post->id }}/delete">Delete</a>
            @endif
        </div>
        @if(!isset($hideCommentPreview) && $post->comments()->count())
        <div>
            @include('comments._comment_preview', ['comments' => $post->comments()->limit(3)->get()])
        </div>
        @endif
    </div>
</article>
