@extends('layouts.app')

@section('content')
<h1 class="title">Conversations</h1>

<div class="card tab-card bootstrap-tabs">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#messagesTab">
                    <i class="fa fa-messages"></i> Messages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#groupChatTab">
                    <i class="fa fa-messages"></i> Group Chats
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body" id="messagesTab">
        <h5 class="card-title">Messages</h5>
        <p>
            <a href="#startConversationModal" data-toggle="modal" class="btn btn-primary">
                <i class="fa fa-envelope"></i> Start Conversation
            </a>
        </p>
        <div class="modal" id="startConversationModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Conversation</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            @foreach(Auth::user()->followers as $user)
                            <a href="/conversations/create/{{ $user->id }}"class="list-group-item">
                                {{ $user->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </div>
    <div class="card-body collapse" id="groupChatTab">
        <h5 class="card-title">Group Chats</h5>
        <p>
            <a href="#startGroupConversation" data-toggle="modal" class="btn btn-primary">
                <i class="fa fa-users"></i> Group Conversation
            </a>
        </p>
    </div>
</div>



@endsection
