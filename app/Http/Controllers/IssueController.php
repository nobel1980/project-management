<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Issue;
use App\Models\User;
use App\Models\IssueStatusHistory;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $issues = $project->issues;
        $issues = $project->issues()->paginate(5); 
        return view('issues.index', compact('project', 'issues'));
    }
    
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        $developers = User::where('role', 'Developer')->get(); // Adjust if using a different role column or system
    
        return view('issues.create', compact('project', 'developers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'requested_date' => 'required|date',
            'tentative_completion_date' => 'required|date|after_or_equal:requested_date',
            'status' => Issue::STATUS_OPEN,  // Default to "Open"
            'assigned_user_id' => 'nullable|exists:users,id',
        ]);
    
        // Create the issue
        $issue = $project->issues()->create([
            'name' => $request->name,
            'description' => $request->description,
            'requested_date' => $request->requested_date,
            'tentative_completion_date' => $request->tentative_completion_date,
            'status' => Issue::STATUS_OPEN, // Default to "Open"
            'assigned_user_id' => $request->assigned_user_id,
        ]);

        // Create an entry in issue_status_histories for the initial "Open" status
        $issue->statusHistories()->create([
            'status' => Issue::STATUS_OPEN,
            'changed_at' => now(),
        ]);

    return redirect()->route('projects.issues.index', $project->id)->with('success', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Issue $issue)
    {
        //$project = Project::findOrFail($projectId);
        $developers = User::where('role', 'Developer')->get();
        return view('issues.edit', compact('project', 'issue', 'developers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Issue $issue)
    {
        $request->validate([
            'name' => 'required',
            'requested_date' => 'required|date',
            'tentative_completion_date' => 'required|date|after_or_equal:requested_date',
            'status' => 'required|in:Open,In Progress,Approved',
            'assigned_user_id' => 'nullable|exists:users,id',
        ]);
    
        $issue->update($request->all());
        return redirect()->route('projects.issues.index', $project->id)->with('success', 'Issue updated successfully.');
    }


    public function updateStatus(Request $request, Issue $issue)
    {
        $user = auth()->user();

        // Store the allowed statuses for each role
        $allowedStatuses = [
            'Developer' => [Issue::STATUS_IN_PROGRESS, Issue::STATUS_DONE],
            'Administrator' => [Issue::STATUS_APPROVED]
        ];
        

        // Check if the user's role allows the requested status
        if (array_key_exists($user->role, $allowedStatuses) && in_array($request->status, $allowedStatuses[$user->role])) {
            $issue->update(['status' => $request->status]);

            // Log the status history after a successful update
            $issue->statusHistories()->create([
                'status' => $request->status,
                'changed_at' => now(),
            ]);

            return response()->json(['message' => 'Issue status updated successfully.']);
        }

        // If the status update is not allowed, return an error
        return response()->json(['message' => 'Unauthorized status update.'], 403);
    }

    public function getIssues()
    {
        $issues = Issue::with(['statusHistories', 'assignedUser'])->get();
        return response()->json($issues);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Issue $issue)
    {
        $issue->delete();
        return redirect()->route('projects.issues.index', $project->id)->with('success', 'Issue deleted successfully.');
    }

    public function showTimeline()
    {
        $issues = Issue::with('statusHistories')->get(); // Fetch issues with status histories
        return view('issues.timeline', compact('issues'));
    }
}
