@extends('layouts.app')

@section('content')
    <h1>Business Units</h1>
    @can('business-unit')
    <a href="{{ route('projects.create') }}" class="btn btn-secondary">Request New Project</a>
    @endcan
    <a href="{{ route('home') }}" class="btn btn-primary">Home</a>

    <ul>
        @foreach ($projects as $project)
            <li>
                {{ $project->name }} - {{ $project->businessUnit->name }}
            </li>
        @endforeach
    </ul>
    <h1>Projects List</h1>
    <ul>
        @foreach ($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project->id) }}">{{ $project->system_name }}</a>
            </li>
        @endforeach
    </ul>
@endsection

