<div class="card mt-4 comment-create">
    <div class="card-body">
        <form class="form-inline" action="/posts/{{ $post->id }}/comments" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-2">
                @include('profiles._avatar_thumbnail', ['user' => $post->user])
            </div>
            <div class="form-group col-8">
                <input type="text" name="body" class="form-control w-100" placeholder="Write a comment" />
            </div>
            <div class="form-group col-2">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            <div class="col-10 offset-2">
                <a href="#addPhotoPane" data-toggle="collapse">
                    <i class="fa fa-camera"></i> Photo
                </a>
                <div id="addPhotoPane" class="collapse">
                    <photo-upload :name="'photo'"></photo-upload>
                </div>
            </div>
        </form>
    </div>
</div>
