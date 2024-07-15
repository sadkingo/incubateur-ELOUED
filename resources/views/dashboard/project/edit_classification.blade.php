@extends('layouts.contentNavbarLayout')

@section('title', trans('project.project_title_classification_edit'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{trans('project.edit_project_classification')}}: {{ $project->name }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('dashboard/project/'.$project->id.'/edit-classification') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="project_classification" class="form-label">{{ trans('auth/project.project_classification') }}</label>
                            <select name="project_classification" id="project_classification" class="form-control @error('project_classification') is-invalid @enderror">
                                <option value="">{{ trans('auth/project.select_project_classification') }}</option>
                                <option value="1" @if($project->project_classification == 1) selected @endif>{{ trans('auth/project.small_scale_enterprise') }}</option>
                                <option value="2" @if($project->project_classification == 2) selected @endif>{{ trans('auth/project.start_up') }}</option>
                                <option value="3" @if($project->project_classification == 3) selected @endif>{{ trans('auth/project.patent') }}</option>
                                <option value="4" @if($project->project_classification == 4) selected @endif>{{ trans('auth/project.patent_start_up') }}</option>
                            </select>
                            @error('project_classification')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">حفظ التعديلات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
