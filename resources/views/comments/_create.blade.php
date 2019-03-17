<div class="card mt-4">
    <div class="card-body">
        <form class="form-inline" action="/posts/{{ $post->id }}/comments" method="POST">
            @csrf
            <div class="form-group col-10">
                <input type="text" name="body" class="form-control w-100" placeholder="Write a comment" />
            </div>
            <div class="form-group col-2">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
