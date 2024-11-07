@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $issue->title }}</h1>
    <p>{{ $issue->description }}</p>
    <p>Status: <strong>{{ $issue->status }}</strong></p>

    @if(auth()->user()->role == 'Developer')
        @if($issue->status == 'Open')
            <form action="{{ route('issues.updateStatus', $issue) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="In Progress">
                <button class="btn btn-primary">Accept and Start Progress</button>
            </form>
        @elseif($issue->status == 'In Progress')
            <form action="{{ route('issues.updateStatus', $issue) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="Done">
                <button class="btn btn-success">Mark as Done</button>
            </form>
        @endif
    @elseif(auth()->user()->role == 'Admin' && $issue->status == 'Done')
        <form action="{{ route('issues.updateStatus', $issue) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="status" value="Review">
            <button class="btn btn-warning">Set to Review</button>
        </form>
        <form action="{{ route('issues.updateStatus', $issue) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="status" value="Complete">
            <button class="btn btn-success">Mark as Complete</button>
        </form>
    @endif
</div>
@endsection
