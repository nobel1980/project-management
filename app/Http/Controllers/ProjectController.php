<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('issues')->get();
        //return view('projects.index', compact('projects'));
        $projects = Project::paginate(5); 
        return view('projects.index', compact('projects'));
    }
    
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
// app/Http/Controllers/ProjectController.php

public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // Create the project using mass assignment
    Project::create($request->only(['name', 'description']));

    // Redirect to the projects index with a success message
    return redirect()->route('projects.index')->with('success', 'Project created successfully.');
}

    
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }
    
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
