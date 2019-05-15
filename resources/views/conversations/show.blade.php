@extends('layouts.app')

@section('content')
<h3 class="title">Conversation {{ $conversation->id }}</h3>

<h5 class="subtitle">
    {{ implode($conversation->users->pluck('name')->toArray(), ', ') }}
</h5>
@if($conversation->group_conversation)

<a href="#inviteUser" data-toggle="modal" class="btn btn-primary">
    <i class="fa fa-plus-circle"></i> Add user
</a>

<div id="inviteUser" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/conversations/{{ $conversation->id }}/invite" method="post">
                {{ method_field('put') }}
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add user to conversation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                    @foreach($addableUsers as $user)
                        <label class="list-group-item">
                            <input type="checkbox" name="invite[]" value="{{ $user->id }}" /> {{ $user->name }}
                        </label>
                    @endforeach
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<div class="message-wrapper mt-4">
    @foreach($conversation->messages as $message)
    @include('conversations._message')
    @endforeach
</div>
@include('conversations._message_create')

@endsection
