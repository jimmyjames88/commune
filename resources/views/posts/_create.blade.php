<div class="card bg-light mb-4">
    <div class="card-header">
        Write a Post
    </div>
    <div class="card-body">
        <form action="/posts" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="What's on your mind?"></textarea>
            </div>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form-group row mb-0">
                <div class="col-8">
                    <a href="#post-emoji-list" data-toggle="collapse">
                        <i class="fa fa-smile-o"></i> Emojis
                    </a>
                    <div id="post-emoji-list" class="collapse emoji-list">
                        <a href="#">&#x1F600</a>
                        <a href="#">&#x1F603</a>
                        <a href="#">&#x1F604</a>
                        <a href="#">&#x1F601</a>
                        <a href="#">&#x1F606</a>
                        <a href="#">&#x1F605</a>
                        <a href="#">&#x1F923</a>
                        <a href="#">&#x1F602</a>
                        <a href="#">&#x1F642</a>
                        <a href="#">&#x1F60A</a>
                        <a href="#">&#x1F607</a>
                        <a href="#">&#x1F60D</a>
                        <a href="#">&#x1F618</a>
                        <a href="#">&#x1F61B</a>
                        <a href="#">&#x1F61D</a>
                        <a href="#">&#x1F92B</a>
                        <a href="#">&#x1F914</a>
                        <a href="#">&#x1F910</a>
                        <a href="#">&#x1F610</a>
                        <a href="#">&#x1F60F</a>
                        <a href="#">&#x1F92E</a>
                        <a href="#">&#x1F608</a>
                        <a href="#">&#x1F480</a>
                        <a href="#">&#x2764</a>
                    </div>
                </div>
                <div class="col-4 text-right">
                    <button type="submit" class="btn btn-primary">Publish</button>
                </div>
            </div>
        </form>
    </div>
</div>
