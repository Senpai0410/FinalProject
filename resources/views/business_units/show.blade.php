@extends('layouts.app')

@section('content')
    <h1>Business Unit Details</h1>
    <p>Name: {{ $businessUnit->name }}</p>
    <a href="{{ route('business_units.index') }}" class="btn btn-primary">Back</a>
@endsection
