@extends('layouts.app')

@section('content')
    <h1>Request New Project</h1>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div class="form-group">
            @csrf
            <label for="system_name">Name:</label>
            <input type="text" name="system_name" id="system_name" required>
        </div>
        <div class="form-group">
            <label for="business_unit_id">Business Unit</label>
            <select name="business_unit_id" id="business_unit_id" class="form-control" required>
                @foreach ($businessUnits as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            @csrf
            <label for="project_type">Project Type</label>
            <select name="project_type" id="project_type" class="form-control" required>
                <option value="new">New System</option>
                <option value="enhancement">Enhancement</option>
            </select>
        </div>


        <button type="submit" class="btn btn-secondary">Submit Request</button>
        <a href="{{ route('home') }}" class="btn btn-primary">Home</a>

    </form>

@endsection

