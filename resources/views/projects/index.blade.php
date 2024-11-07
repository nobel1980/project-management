@extends('layouts.sidebar')

@section('content')
    <div class="container mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Projects</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>All Projects</h4>
            <a href="{{ route('projects.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add Project
            </a>
        </div>
        @if ($projects->isEmpty())
            <div class="alert alert-info mt-3">No projects found.</div>
        @else    
            <table class="table table-striped table-bordered mt-3">
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
                            <td>
                                <a href="{{ route('projects.issues.index', ['project' => $project->id]) }}">
                                    {{ $project->name }}
                                </a>
                            </td>
                            <td>{{ $project->description }}</td>
                            <td>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="{{ route('projects.issues.index', $project->id) }}" class="btn btn-sm btn-info" title="View Issues">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
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
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
