@extends('layouts.sidebar')

@section('content')
<div class="container mt-5">
    <h2>Issue Status Timeline</h2>
    <div class="row">
        @php
            $statuses = [
                'Open' => 'bg-primary',
                'In Progress' => 'bg-warning',
                'Done' => 'bg-success',
                'Review' => 'bg-info',
                'Approved' => 'bg-dark',
                'Failed' => 'bg-danger'
            ];
        @endphp

        <!-- Display each status as a column with colors -->
        @foreach ($statuses as $status => $color)
            <div class="col-md-2">
                <h5 class="text-center">{{ $status }}</h5>
                <div class="status-column {{ $color }} p-3" data-status="{{ $status }}">
                    @foreach ($issues as $issue)
                        @if ($issue->status === $status)
                            <div class="card mb-2 issue-card" data-issue-id="{{ $issue->id }}">
                                <div class="card-body p-2">
                                    <p class="card-text">{{ $issue->name }}</p>
                                    <small class="text-muted">Updated: {{ $issue->statusHistories->last()->changed_at ?? 'N/A' }}</small>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Include jQuery and jQuery UI for drag-and-drop functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        $(".status-column").droppable({
            accept: ".issue-card",
            hoverClass: "bg-secondary",
            drop: function(event, ui) {
                var issueId = ui.draggable.data("issue-id");
                var newStatus = $(this).data("status");

                $(this).append(ui.draggable);

                $.ajax({
                    url: `/issues/${issueId}/update-status`,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newStatus
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr) {
                        alert("An error occurred while updating the status.");
                    }
                });
            }
        });

        $(".issue-card").draggable({
            revert: "invalid",
            helper: "clone",
            cursor: "move",
            opacity: 0.7
        });
    });
</script>
@endsection

<style>
    /* Custom styles for color-coded issue timeline */
    .status-column {
        min-height: 300px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .bg-primary { background-color: #007bff; }
    .bg-warning { background-color: #ffc107; }
    .bg-success { background-color: #28a745; }
    .bg-info { background-color: #17a2b8; }
    .bg-dark { background-color: #343a40; }
    .bg-danger { background-color: #dc3545; }

    .issue-card {
        cursor: move;
        margin-bottom: 10px;
        background-color: #f8f9fa;
    }

</style>    