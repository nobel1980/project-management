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
                                    <hr>
                                    @php
                                        $changedAt = $issue->statusHistories->last()?->changed_at 
                                            ? \Illuminate\Support\Carbon::parse($issue->statusHistories->last()->changed_at) 
                                            : null;
                                    @endphp
                                    <small class="text-muted">Updated: {{ $changedAt ? $changedAt->format('d M y') : 'N/A' }}
                                    </small>
                                    <small>Assigned to: <span class="badge bg-secondary">{{ $issue->assignedUser->name ?? 'Unassigned' }}</span></small>                                    
                                    
                                    @if ($issue->status === 'Open' || $issue->status === 'In Progress')                                                                           
                                        @if ($issue->tentative_completion_date > now()) 
                                            <p>Remaining: <span class="badge bg-warning">{{ now()->diffInDays($issue->tentative_completion_date) }}</span> Day(s)</p>
                                        @endif    
                                    @elseif ($issue->status === 'Done')
                                        <p><span class="badge bg-primary">Waiting for Approval</span></p>
                                    @endif
 
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
$(function() {
    var allowedStatuses = {
        'Administrator': ['Approved'], 
        'Developer': ['In Progress', 'Done']
    };

    var userRole = @json(auth()->user()->role);

    $(".status-column").droppable({
        accept: function(draggable) {
            var newStatus = $(this).data("status");
            return allowedStatuses[userRole].includes(newStatus); 
        },
        hoverClass: "bg-secondary",
        drop: function(event, ui) {
            var issueId = ui.draggable.data("issue-id");
            var newStatus = $(this).data("status");

            if (!allowedStatuses[userRole].includes(newStatus)) {
                alert("You are not authorized to move to this status.");
                return;
            }

            $(this).append(ui.draggable);

            // Send the update request via AJAX
            $.ajax({
                url: `/issues/${issueId}/update-status`,
                type: "POST",
                data: {
                    status: newStatus
                },
                success: function(response) {
                    alert(response.message);
                    reloadIssues(); // Call a function to reload draggable issues
                },

                error: function(xhr) {
                    console.error("Error:", xhr); // Log the full error to the console for debugging
                    // Try to extract the error message from the server's response
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        alert("Error: " + xhr.responseJSON.message);
                    } else if (xhr.responseText) {
                        alert("Error: " + xhr.responseText); // Display the full response text if no JSON message
                    } else {
                        alert("An unexpected error occurred. Please check the console for details.");
                    }
                }
            });
        }
    });

    // Make issues draggable
    $(".issue-card").draggable({
        revert: "invalid", // Revert if dropped in an invalid column
        helper: "clone",
        cursor: "move",
        opacity: 0.7
    });
});

function reloadIssues() {
    $.ajax({
        url: '/issues/timeline', // Adjust the URL to your endpoint
        type: 'GET',
        success: function(issues) {
            // Clear existing issue cards from columns
            $(".status-column").empty();

            // Populate status columns with updated issues
            issues.forEach(function(issue) {
                var issueCard = `
                    <div class="card mb-2 issue-card" data-issue-id="${issue.id}">
                        <div class="card-body p-2">
                            <p class="card-text">${issue.name}</p>
                            <small class="text-muted">
                                Updated: ${issue.statusHistories.length > 0 ? issue.statusHistories[issue.statusHistories.length - 1].changed_at : 'N/A'}
                            </small>
                            <small>
                                Assigned to: <span class="badge bg-secondary">${issue.assigned_user ? issue.assigned_user.name : 'Unassigned'}</span>
                            </small>
                        </div>
                    </div>
                `;

                // Append the issue to the correct status column
                $(`.status-column[data-status="${issue.status}"]`).append(issueCard);
            });

            // Reinitialize draggable after dynamically updating the UI
            initializeDraggable();
        },
        error: function(xhr) {
            console.error("Error fetching updated issues:", xhr);
            alert("Failed to reload issues. Please try again.");
        }
    });
}

// Function to reinitialize draggable after dynamic updates
function initializeDraggable() {
    $(".issue-card").draggable({
        revert: "invalid",
        helper: "clone",
        cursor: "move",
        opacity: 0.7
    });
}


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