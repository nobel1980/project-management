@extends('layouts.sidebar')

@section('content')
    <div class="container mt-5">
        <h2>Projects</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add New Project</a>

        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('projects.issues.index', $project->id) }}" class="btn btn-sm btn-info">View Issues</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this project?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($projects->isEmpty())
            <div class="alert alert-info mt-3">No projects found.</div>
        @endif
    </div>
@endsection
