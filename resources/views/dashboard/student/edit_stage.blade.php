@extends('layouts/contentNavbarLayout')

@section('title', trans('student.profile.title'))

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ trans('student.dashboard') }} / {{ trans('student.update_project_stage') }}/ </span>
    {{ trans('student.update_project_stage') }}
</h4>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ trans('student.update_project_stage') }}</h5>
        <form action="{{ url('/dashboard/students/' . $student->id . '/updateStage') }}" method="POST">
            @csrf
            @method('POST') 
            <div id="dynamic-fields">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <select name="stage" id="stage" class="form-control @error('stage') is-invalid @enderror">
                            <option value="0" @if($student->project_stage == 0) selected @endif>{{trans('student.select_a_stage')}}</option>
                            <option value="1" @if($student->project_stage == 1) selected @endif>{{trans('student.business_model_preparation')}}</option>
                            <option value="2" @if($student->project_stage == 2) selected @endif>{{trans('student.prototype_development')}}</option>
                            <option value="3" @if($student->project_stage == 3) selected @endif>{{trans('student.startup_dz_registration')}}</option>
                            <option value="4" @if($student->project_stage == 4) selected @endif>{{trans('student.discussion')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mt-3 d-flex">
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="submit-button">{{trans('auth/student.edit')}}</button>
                   
                </div>
            </div>        
        </form>
    </div>
</div>
@endsection        
