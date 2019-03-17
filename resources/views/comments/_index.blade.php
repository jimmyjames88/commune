
<div class="list-group">
    @foreach ($post->comments as $comment)
        @include('comments._comment')
    @endforeach
</div>
