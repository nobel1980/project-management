@extends('layouts.sidebar')

@section('title', 'Issues')

@section('content')
    <div class="container mt-5">  
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('projects.index') }}">Projects</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
            </ol>
        </nav>              
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ $project->name }} : Issue</h2>
            <a href="{{ route('projects.issues.create', $project->id) }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add New Issue
            </a>
        </div>
        @if ($issues->isEmpty())
            <div class="alert alert-info">
                No issues found for this project.
            </div>
        @else
            <table class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Initial Date</th>
                        <th>Completion Date</th>
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
                            <td>{{ \Carbon\Carbon::parse($issue->requested_date)->format('d M y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($issue->tentative_completion_date)->format('d M y') }}</td>
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
                                <a href="{{ route('projects.issues.edit', [$project->id, $issue->id]) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- <a href="{{ route('projects.issues.index', $project->id) }}" class="btn btn-sm btn-info" title="View Issues">
                                    <i class="bi bi-eye"></i>
                                </a> -->

                                <form action="{{ route('projects.issues.destroy', [$project->id, $issue->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $issues->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection



