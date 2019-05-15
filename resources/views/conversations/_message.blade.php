<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $message->user->name }}</h5>
        <h6 class="card-subtitle">{{ $message->created_at->diffForHumans() }}</h6>
        <div class="card-text">
            {{ $message->body }}
        </div>
    </div>
</div>
