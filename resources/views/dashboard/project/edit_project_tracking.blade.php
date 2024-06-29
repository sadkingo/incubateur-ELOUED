@extends('layouts.contentNavbarLayout')

@section('title', trans('project.project_title_tracking_add'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{trans('project.add_project_tracking')}}: {{ $project->name }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('dashboard/project/'.$project->id.'/edit-project-tracking') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="project_tracking" class="form-label">{{ trans('auth/project.project_trackingg') }}</label>
                            <select name="project_tracking" id="project_tracking" class="form-control @error('project_tracking') is-invalid @enderror">
                                <option value="">{{ trans('auth/project.project_tracking.select_a_stage') }}</option>
                                <option value="1" @if($project->project_tracking == 1) selected @endif>{{ trans('auth/project.project_tracking.configuration_stage') }}</option>
                                <option value="2" @if($project->project_tracking == 2) selected @endif>{{ trans('auth/project.project_tracking.create_bmc') }}</option>
                                <option value="3" @if($project->project_tracking == 3) selected @endif>{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}</option>
                                <option value="4" @if($project->project_tracking == 4) selected @endif>{{ trans('auth/project.project_tracking.discussion_stage') }}</option>
                                <option value="5" @if($project->project_tracking == 5) selected @endif>{{ trans('auth/project.project_tracking.labelle_innovative_project') }}</option>
                            </select>
                            @error('project_tracking')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
