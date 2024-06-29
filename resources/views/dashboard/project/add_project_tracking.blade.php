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

                    <form method="POST" action="{{ url('dashboard/project/'.$project->id.'/add-project-tracking') }}">
                        @csrf

                        <div class="form-group">
                            <label for="project_tracking" class="form-label">{{ trans('auth/project.project_trackingg') }}</label>
                            <select name="project_tracking" id="project_tracking" class="form-control @error('project_tracking') is-invalid @enderror">
                                @if($project->project_classification == 1 ||  $project->project_classification == 2)
                                    <option value="" >{{ trans('auth/project.project_tracking.select_a_stage') }}</option>
                                    <option value="1">{{ trans('auth/project.project_tracking.configuration_stage') }}</option>
                                    <option value="2">{{ trans('auth/project.project_tracking.create_bmc') }}</option>
                                    <option value="3">{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}</option>
                                    <option value="4">{{ trans('auth/project.project_tracking.discussion_stage') }}</option>
                                    <option value="5">{{ trans('auth/project.project_tracking.labelle_innovative_project') }}</option>
                                @else
                                    <option value="1">{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}</option>
                                    <option value="2">{{ trans('auth/project.project_tracking.write_a_descriptive_model') }}</option>
                                    <option value="3">{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}</option>
                                    <option value="4">{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}</option>
                                    <option value="5">{{ trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI') }}</option>
                                    <option value="6">{{ trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations') }}</option>
                                    <option value="7">{{ trans('auth/project.project_tracking.obtained_a_patent') }}</option>
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
