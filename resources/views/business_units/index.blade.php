
@extends('layouts.app')
@section('content')
    <h1>Business Units</h1>
    <a href="{{ route('business_units.create') }}">Create New Business Unit</a>
    <ul>
        @foreach ($businessUnits as $unit)
            <li>
                {{ $unit->name }}
                <a href="{{ route('business_units.show', $unit->id) }}">View</a>
                <a href="{{ route('business_units.edit', $unit->id) }}">Edit</a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
@endsection
