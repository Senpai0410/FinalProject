<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\BusinessUnit;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }


    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $businessUnits = BusinessUnit::all();
        $users = User::where('role', 'developer')->get(); // Assuming 'developer' role
        return view('projects.create', compact('businessUnits', 'users'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'system_name' => 'required|string|max:255',
            'business_unit_id' => 'required|integer|exists:business_units,id',
            'project_type' => 'required|string',

        ]);
        $businessUnitId = $request->input('business_unit_id');
        $businessUnitName = BusinessUnit::findOrFail($businessUnitId)->name;
        Project::create([
            'system_owner' => $businessUnitName,
            'system_name' => $request->system_name,
            'business_unit_id' => $request->business_unit_id,
            'project_type' => $request->project_type,
            'project_status' => 'Pending Request',
            // Include other fields as necessary
        ]);
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project.
     */
    public function show($id)
    {
        $project = Project::with(['businessUnit', 'progressReports'])->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $businessUnits = BusinessUnit::all();
        $users = User::where('role', 'developer')->get();
        return view('projects.edit', compact('project', 'businessUnits', 'users'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $validatedData = $request->validate([
            'business_unit_id' => 'required|exists:business_units,id',
            'system_pic' => 'nullable|string|max:255',
            'project_start_date' => 'nullable|date',
            'project_duration' => 'nullable|integer',
            'project_end_date' => 'nullable|date|after_or_equal:project_start_date',
            'project_status' => 'nullable|string|max:255',
            'developers' => 'nullable|string|max:255',
            'lead_developer' => 'nullable|string|max:255',
            'development_methodology' => 'nullable|string|max:255',
            'system_platform' => 'nullable|string|max:255',
            'deployment_type' => 'nullable|string|max:255',
        ]);
        $startDate = \Carbon\Carbon::parse($validatedData['project_start_date']);
        $endDate = \Carbon\Carbon::parse($validatedData['project_end_date']);
        $duration = $startDate->diffInDays($endDate);
        $project->fill($validatedData);
        $project->project_duration = $duration;
        $project->update($validatedData);

        return redirect()->route('projects.show',$project->id)->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
