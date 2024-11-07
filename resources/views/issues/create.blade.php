@extends('layouts.sidebar')

@section('content')
    <div class="container mt-5">
        <h2>Project: {{ $project->name }}</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('projects.index') }}">Projects</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('projects.index') }}">{{ $project->name }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('projects.index') }}">Issues</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Project Issue</h4>
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

        <form action="{{ route('projects.issues.store', $project->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Issue Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ old('name') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="description">Issue Description</label>
                <textarea name="description" class="form-control" id="description" rows="3" placeholder="" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group mt-3">
                <label for="requested_date">Initial Date</label>
                <input type="date" name="requested_date" class="form-control" id="requested_date" value="{{ old('requested_date') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="tentative_completion_date">Completion Date</label>
                <input type="date" name="tentative_completion_date" class="form-control" id="tentative_completion_date" value="{{ old('tentative_completion_date') }}" required>
            </div>



            <!-- Developer Assignment Dropdown -->
            <div class="form-group mt-3">
                <label for="assigned_user_id">Assign Developer</label>
                <select name="assigned_user_id" class="form-control" id="assigned_user_id">
                    <option value="">Select Developer</option>
                    @foreach ($developers as $developer)
                        <option value="{{ $developer->id }}" {{ old('assigned_user_id') == $developer->id ? 'selected' : '' }}>
                            {{ $developer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Issue</button>
            <a href="{{ route('projects.issues.index', $project->id) }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
