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

                    <form method="POST" action="{{ url('dashboard/project/'.$project->id.'/edit-status-project-tracking') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status_project_tracking" class="form-label">{{ trans('auth/project.project_trackingg') }}</label>
                            
                            <select name="status_project_tracking" id="status_project_tracking" class="form-control @error('project_tracking') is-invalid @enderror">
                                <option value="">{{ trans('auth/project.project_tracking.select_a_stage') }}</option>
                                @if($project->project_classification == 1 ||  $project->project_classification == 2)
                                    @if($project->project_tracking == 1)    
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.practice') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.complete') }}</option>
                                        <option value="3" @if($project->status_project_tracking == 3) selected @endif>{{ trans('auth/project.status_project_tracking.not_yet') }}</option>
                                    @elseif($project->project_tracking == 2 || $project->project_tracking == 3)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.development_mode') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.accomplished') }}</option>
                                        <option value="3" @if($project->status_project_tracking == 3) selected @endif>{{ trans('auth/project.status_project_tracking.not_completed') }}</option>
                                    @elseif($project->project_tracking == 4)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.not_discussed') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.discuss') }}</option>
                                    @else
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.did_not_happen') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.get') }}</option>
                                        <option value="3" @if($project->status_project_tracking == 3) selected @endif>{{ trans('auth/project.status_project_tracking.exclusion_or_waiver_of_the_student') }}</option>   
                                    @endif
                                @elseif($project->project_classification == 3)
                                    @if($project->project_tracking == 1)    
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.development_mode') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.accomplished') }}</option>
                                        <option value="3" @if($project->status_project_tracking == 3) selected @endif>{{ trans('auth/project.status_project_tracking.not_completed') }}</option>
                                    @elseif($project->project_tracking == 2 )
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.no') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.yes') }}</option>
                                    @elseif($project->project_tracking == 4)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.did_not_happen') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.get') }}</option>
                                    @elseif($project->project_tracking == 7)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.no') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.yes') }}</option>
                                    @endif
                                @else
                                    @if($project->project_tracking == 1)    
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.practice') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.complete') }}</option>
                                        <option value="3" @if($project->status_project_tracking == 3) selected @endif>{{ trans('auth/project.status_project_tracking.not_yet') }}</option>
                                    @elseif($project->project_tracking == 2 || $project->project_tracking == 3)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.development_mode') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.accomplished') }}</option>
                                        <option value="3" @if($project->status_project_tracking == 3) selected @endif>{{ trans('auth/project.status_project_tracking.not_completed') }}</option>
                                        @elseif($project->project_tracking == 4 )
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.no') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.yes') }}</option>
                                    @elseif($project->project_tracking == 6)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.did_not_happen') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.get') }}</option>
                                    @elseif($project->project_tracking == 9)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.not_discussed') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.discuss') }}</option>    
                                    @elseif($project->project_tracking == 10)
                                        <option value="1" @if($project->status_project_tracking == 1) selected @endif>{{ trans('auth/project.status_project_tracking.no') }}</option>
                                        <option value="2" @if($project->status_project_tracking == 2) selected @endif>{{ trans('auth/project.status_project_tracking.yes') }}</option>
                                    @endif    
                                @endif    
                            </select>
                            @error('status_project_tracking')
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
