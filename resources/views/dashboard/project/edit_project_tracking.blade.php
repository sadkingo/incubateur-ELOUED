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
                                @if($project->project_classification == 1 ||  $project->project_classification == 2)
                                    <option value="1" @if($project->project_tracking == 1) selected @endif>{{ trans('auth/project.project_tracking.configuration_stage') }}</option>
                                    <option value="2" @if($project->project_tracking == 2) selected @endif>{{ trans('auth/project.project_tracking.create_bmc') }}</option>
                                    <option value="3" @if($project->project_tracking == 3) selected @endif>{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}</option>
                                    <option value="4" @if($project->project_tracking == 4) selected @endif>{{ trans('auth/project.project_tracking.discussion_stage') }}</option>
                                    <option value="5" @if($project->project_tracking == 5) selected @endif>{{ trans('auth/project.project_tracking.labelle_innovative_project') }}</option>
                                @elseif($project->project_classification == 3)
                                    <option value="1" @if($project->project_tracking == 1) selected @endif >{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}</option>
                                    <option value="2" @if($project->project_tracking == 2) selected @endif >{{ trans('auth/project.project_tracking.write_a_descriptive_model') }}</option>
                                    <option value="3" @if($project->project_tracking == 3) selected @endif >{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}</option>
                                    <option value="4" @if($project->project_tracking == 4) selected @endif >{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}</option>
                                    <option value="5" @if($project->project_tracking == 5) selected @endif >{{ trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI') }}</option>
                                    <option value="6" @if($project->project_tracking == 6) selected @endif >{{ trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations') }}</option>
                                    <option value="7" @if($project->project_tracking == 7) selected @endif >{{ trans('auth/project.project_tracking.obtained_a_patent') }}</option>
                                @elseif($project->project_classification == 4 )
                                    <option value="1"  @if($project->project_tracking == 1 ) selected @endif >{{ trans('auth/project.project_tracking.configuration_stage') }}</option>
                                    <option value="2"  @if($project->project_tracking == 2 ) selected @endif >{{ trans('auth/project.project_tracking.create_bmc') }}</option>
                                    <option value="3"  @if($project->project_tracking == 3 ) selected @endif >{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}</option>
                                    <option value="4"  @if($project->project_tracking == 4 ) selected @endif >{{ trans('auth/project.project_tracking.write_a_descriptive_model') }}</option>
                                    <option value="5"  @if($project->project_tracking == 5 ) selected @endif >{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}</option>
                                    <option value="6"  @if($project->project_tracking == 6 ) selected @endif >{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}</option>
                                    <option value="7"  @if($project->project_tracking == 7 ) selected @endif >{{ trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI') }}</option>
                                    <option value="8"  @if($project->project_tracking == 8 ) selected @endif >{{ trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations') }}</option>
                                    <option value="9"  @if($project->project_tracking == 9 ) selected @endif >{{ trans('auth/project.project_tracking.discussion_stage') }}</option>
                                    <option value="10" @if($project->project_tracking == 10) selected @endif >{{ trans('auth/project.project_tracking.obtained_a_patent_startup') }}</option>
                                @endif   
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
