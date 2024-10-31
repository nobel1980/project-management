<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
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
        return view('issues.index', compact('project', 'issues'));
    }
    
    public function create(Project $project)
    {
        return view('issues.create', compact('project'));
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
            'requested_date' => 'required|date',
            'tentative_completion_date' => 'required|date|after_or_equal:requested_date',
            'status' => 'required|in:Open,In Progress,Approved',
        ]);
    
        $project->issues()->create($request->all());
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
        return view('issues.edit', compact('project', 'issue'));
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
        ]);
    
        $issue->update($request->all());
        return redirect()->route('projects.issues.index', $project->id)->with('success', 'Issue updated successfully.');
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
}
