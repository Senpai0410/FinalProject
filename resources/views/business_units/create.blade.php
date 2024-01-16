@extends('layouts.app')

@section('content')
    <h1>Create Business Unit</h1>
    <form method="POST" action="{{ route('business_units.store') }}">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create</button>
    </form>
    <a href="{{ route('business_units.index') }}" class="btn btn-primary">Back</a>
@endsection
