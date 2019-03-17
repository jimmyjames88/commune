@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Delete {{ $type }}</h5>
        <p class="card-text">This action cannot be undone.</p>
        <div>
            <form action="{{ $action }}" method="POST">
                {{ method_field('delete') }}
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="{{ url()->previous() }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
