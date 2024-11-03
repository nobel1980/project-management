@extends('layouts.sidebar')

@section('title', 'Edit Project')

@section('content')
    <div class="container mt-5">
        <h2>Edit Project: {{ $project->name }}</h2>

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

            <button type="submit" class="btn btn-primary mt-3">Update Project</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
