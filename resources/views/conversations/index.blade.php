@extends('layouts.app')

@section('content')
<h1 class="title">Conversations</h1>
<div class="list-group">
@foreach($conversations as $conversation)
<a href="/conversations/{{ $conversation->id }}" class="list-group-item">
    @foreach($conversation->users()->where('users.id', '!=', Auth::id())->get() as $user)
    {{ $user->name }} 
    @endforeach

    @if($conversation->unread_messages)
        <span class="badge badge-secondary float-right">{{ $conversation->unread_messages }}</span>
    @endif
</a>
@endforeach
</div>
@endsection
