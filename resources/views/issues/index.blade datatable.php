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
            <table id="issuesTable" class="table table-bordered">
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

    <!-- DataTables Initialization Script -->
    <script>
        $(document).ready(function() {
            $('#issuesTable').DataTable({
                "order": [
                    [4, 'asc'],  // Default sort by status column (index 4)
                    [3, 'asc']   // Then by tentative_completion_date column (index 3)
                ],
                "columnDefs": [
                    { "type": "date", "targets": 3 }  // Specify date sorting for tentative_completion_date
                ],
                "paging": true,          // Enable pagination
                "searching": true,       // Enable search
                "info": true,            // Show table information (e.g., "Showing 1 to 10 of 50 entries")
                "lengthChange": true,    // Enable changing number of records shown
                "pageLength": 10         // Set default records per page
            });
        });
    </script>
@endsection
