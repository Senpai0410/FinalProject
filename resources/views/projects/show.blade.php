@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Project Details: {{ $project->system_name }}</h1><br>
                <h5>System Owner: {{ $project->businessUnit->name }}</h5><br><br>
                <h5>System PIC: {{ $project->system_pic }}</h5><br><br>
                <h5>Start Date: {{ $project->project_start_date }}</h5><br>
                <h5>Duration: {{ $project->project_duration }} days</h5><br>
                <h5>End Date: {{ $project->project_end_date }}</h5><br>
                <h5>Status: {{ $project->project_status }}</h5><br>
                <h5>Developers: {{ $project->project_developers }}</h5><br>
                <h5>Lead Developer: {{ $project->lead_developer }}</h5><br>
                <h5>Methodology: {{ $project->development_methodology }}</h5><br>
                <h5>Platform: {{ $project->system_platform }}</h5><br>
                <h5>Deployment Type: {{ $project->deployment_type }}</h5><br>
            </div>

            <div class="col-md-6">
                <h1>Update Project</h1>
                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                    <input type="hidden" name="business_unit_id" value="{{ $project->business_unit_id }}">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="system_pic">System PIC:</label>
                        <input type="text" name="system_pic" id="system_pic" value="{{ $project->system_pic }}" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="project_start_date">Project Start Date:</label>
                        <input type="date" name="project_start_date" id="project_start_date" value="{{ $project->project_start_date }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="project_end_date">Project End Date:</label>
                        <input type="date" name="project_end_date" id="project_end_date" value="{{ $project->project_end_date }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Project Duration:</label>
                        <p>{{ $project->project_duration }} days</p>
                    </div>

                    <div class="form-group">
                        <label for="project_status">Project Status:</label>
                        <select name="project_status" id="project_status" class="form-control">
                            <option value="pending" {{ $project->project_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in progress" {{ $project->project_status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $project->project_status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="developers">Developers:</label>
                        <input type="text" name="developers" id="developers" value="{{ $project->developers }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="lead_developer">Lead Developer:</label>
                        <input type="text" name="lead_developer" id="lead_developer" value="{{ $project->lead_developer }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="development_methodology">Development Methodology:</label>
                        <input type="text" name="development_methodology" id="development_methodology" value="{{ $project->development_methodology }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="system_platform">System Platform:</label>
                        <select name="system_platform" id="system_platform" class="form-control">
                            <option value="web-based" {{ $project->system_platform == 'web-based' ? 'selected' : '' }}>Web-Based</option>
                            <option value="mobile" {{ $project->system_platform == 'mobile' ? 'selected' : '' }}>Mobile</option>
                            <option value="stand-alone" {{ $project->system_platform == 'stand-alone' ? 'selected' : '' }}>Stand-Alone</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="deployment_type">Deployment Type:</label>
                        <select name="deployment_type" id="deployment_type" class="form-control">
                            <option value="cloud" {{ $project->deployment_type == 'cloud' ? 'selected' : '' }}>Cloud</option>
                            <option value="on-premises" {{ $project->deployment_type == 'on-premises' ? 'selected' : '' }}>On-Premises</option>
                        </select>
                    </div>
                    @can('update-project')
                    <br><button type="submit" class="btn btn-primary">Update Project</button>
                    @endcan
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Back</a>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Progress Reports</h2>
                <h3>Add New Progress Report</h3>
                <form action="{{ route('progress-reports.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label for="new_date_of_progress">Date of Progress:</label>
                        <input type="date" name="date_of_progress" id="new_date_of_progress" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_status">Status:</label>
                        <select name="status" id="new_status" class="form-control">
                            <option value="ahead of schedule">Ahead of Schedule</option>
                            <option value="on schedule">On Schedule</option>
                            <option value="delayed">Delayed</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="new_description">Description:</label>
                        <textarea name="description" id="new_description" class="form-control"></textarea>
                    </div>
                    @can('add-report')
                    <button type="submit" class="btn btn-primary">Add Report</button>
                    @endcan
                </form>

                @foreach ($project->progressReports as $report)
                    <div class="card mb-3">
                        <div class="card-header">
                            Progress Report ({{ $report->date_of_progress->format('Y-m-d') }})
                        </div>
                        <div class="card-body">
                            <p>Status: {{ $report->status }}</p>
                            <p>Description: {{ $report->description }}</p>
                            <div id="editReport{{ $report->id }}" class="collapse mt-3">
                                <form action="{{ route('progress_reports.update', $report->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <input type="text" name="status" id="status" value="{{ $report->status }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" id="description" class="form-control">{{ $report->description }}</textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

