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


    public function create1(Request $request)
{
    // Only accessible to Admins
    $issue = Issue::create([
        'title' => $request->title,
        'description' => $request->description,
        'status' => Issue::STATUS_OPEN,
        'assigned_user_id' => $request->assigned_user_id, // Assign developer here
    ]);
    
    return redirect()->route('issues.index')->with('success', 'Issue created and assigned to developer.');
}

public function updateStatus(Request $request, Issue $issue)
{
    $user = auth()->user();

    if ($user->role === 'Developer') {
        if ($request->status === Issue::STATUS_IN_PROGRESS) {
            $issue->update(['status' => Issue::STATUS_IN_PROGRESS]);
        } elseif ($request->status === Issue::STATUS_DONE) {
            $issue->update(['status' => Issue::STATUS_DONE]);
        }
    } elseif ($user->role === 'Admin') {
        if ($request->status === Issue::STATUS_REVIEW || $request->status === Issue::STATUS_COMPLETE) {
            $issue->update(['status' => $request->status]);
        }
    }

    return redirect()->route('issues.show', $issue)->with('success', 'Issue status updated.');
}

public function updateStatus1(Request $request, $id)
{
    $issue = Issue::findOrFail($id);
    $newStatus = $request->status;

    // Update status and track in history
    $issue->updateStatus($newStatus);

    return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
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
