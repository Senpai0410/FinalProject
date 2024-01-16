@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body">
                    <p>Welcome to the Project Management System.</p>
                    @can('business-unit')
                    <a href="{{ route('business_units.index') }}" class="btn btn-primary">Go to Business Unit </a>
                    @endcan
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Go to Project </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
