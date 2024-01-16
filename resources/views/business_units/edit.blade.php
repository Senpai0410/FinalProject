@extends('layouts.app')

@section('content')
    <h1>Edit Business Unit</h1>
    <form method="POST" action="{{ route('business_units.update', $businessUnit->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $businessUnit->name }}" required>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('business_units.index') }}" class="btn btn-primary">Back</a>
@endsection

