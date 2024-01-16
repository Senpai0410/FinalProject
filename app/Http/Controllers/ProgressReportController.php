<?php

namespace App\Http\Controllers;

use App\Models\ProgressReport;
use App\Models\Project;
use Illuminate\Http\Request;

class ProgressReportController extends Controller
{

    public function index()
    {
        $progressReports = ProgressReport::all();
        return view('progress_reports.index', compact('progressReports'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('progress_reports.create', compact('projects'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'date_of_progress' => 'required|date',
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $progressReport = new ProgressReport($validatedData);
        $progressReport->save();

        return redirect()->route('projects.show', $validatedData['project_id'])
            ->with('success', 'Progress report added successfully.');
    }


    public function show(ProgressReport $progressReport)
    {
        return view('progress_reports.show', compact('progressReport'));
    }

    public function edit(ProgressReport $progressReport)
    {
        $projects = Project::all();
        return view('progress_reports.edit', compact('progressReport', 'projects'));
    }


    public function update(Request $request, $id)
    {
        $report = ProgressReport::findOrFail($id);

        $validatedData = $request->validate([
            'date_of_progress' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $report->update($validatedData);

        return redirect()->route('projects.show', $report->project_id)
            ->with('success', 'Progress report updated successfully.');
    }


    public function destroy(ProgressReport $progressReport)
    {
        $progressReport->delete();
        return redirect()->route('progress_reports.index')->with('success', 'Progress Report deleted successfully.');
    }
}
