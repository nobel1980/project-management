@extends('layouts.sidebar')

@section('title', 'Issues')

@section('content')
    <div class="container mt-5">
        <h2> {{ $project->name }} : Issues</h2>
        <a href="{{ route('projects.issues.create', $project->id) }}" class="btn btn-primary mt-3 mb-3">Add New Issue</a>

        @if ($issues->isEmpty())
            <div class="alert alert-info">
                No issues found for this project.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Requested Date</th>
                        <th>Tentative Completion Date</th>
                        <th>Status</th>
                        <th>Developer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($issues as $issue)
                        <tr>
                            <td>{{ $issue->name }}</td>
                            <td>{{ $issue->description }}</td>
                            <td>{{ $issue->requested_date }}</td>
                            <td>{{ $issue->tentative_completion_date }}</td>
                            <td>
                                @if ($issue->status === 'Open')
                                    <span class="badge bg-warning text-dark">Open</span>
                                @elseif ($issue->status === 'In Progress')
                                    <span class="badge bg-primary">In Progress</span>
                                @elseif ($issue->status === 'Approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Completion Failed</span>
                                @endif
                            </td>
                            <td>{{ $issue->assignedUser ? $issue->assignedUser->name : 'Unassigned' }}</td>
                            <td>
                                <a href="{{ route('projects.issues.edit', [$project->id, $issue->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('projects.issues.destroy', [$project->id, $issue->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection



