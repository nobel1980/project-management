@extends('layouts.sidebar')

@section('content')
    <div class="container mt-5">
        <!-- Breadcrumb -->
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
            <h4>Edit Project</h4>
            <a href="{{ route('projects.index') }}" class="btn btn-success">
            <i class="bi bi-reply-fill"></i> Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Project Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter project name" value="{{ old('name', $project->name) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="description">Project Description</label>
                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter project description" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
