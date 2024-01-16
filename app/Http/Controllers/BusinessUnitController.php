<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use Illuminate\Http\Request;

class BusinessUnitController extends Controller
{
    public function index()
    {
        $businessUnits = BusinessUnit::all();
        return view('business_units.index', compact('businessUnits'));
    }

    public function create()
    {
        return view('business_units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        BusinessUnit::create($request->all());
        return redirect()->route('business_units.index')->with('success', 'Business Unit created successfully.');
    }

    public function show(BusinessUnit $businessUnit)
    {
        return view('business_units.show', compact('businessUnit'));
    }

    public function edit(BusinessUnit $businessUnit)
    {
        return view('business_units.edit', compact('businessUnit'));
    }

    public function update(Request $request, BusinessUnit $businessUnit)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $businessUnit->update($request->all());
        return redirect()->route('business_units.index')->with('success', 'Business Unit updated successfully.');
    }

    public function destroy(BusinessUnit $businessUnit)
    {
        $businessUnit->delete();
        return redirect()->route('business_units.index')->with('success', 'Business Unit deleted successfully.');
    }
}
