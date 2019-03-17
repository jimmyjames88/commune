<form action="/conversations/{{ $conversation->id }}/messages" method="POST" class="mt-4">
    @csrf
    <div class="form-group row">
        <div class="col-10">
            <textarea name="body" class="form-control" placeholder="Write something..."></textarea>
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </div>

</form>
