@extends('layouts.contentNavbarLayout')

@section('title', trans('project.project_title_classification_edit'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{trans('project.edit_bmc_status')}}: {{ $project->name }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="wow fadeIn">
                        <div class="text-start mb-1-6 wow fadeIn">
                            <h2 class="mb-0 text-primary">{{trans('project.label.bmc_project')}}</h2>
                        </div>
                        <a href="{{ asset('storage/public/projects/bmc/'.$project->bmc) }}" class="text-black" target="_blank">{{ trans('project.label.download_bmc')}}</a>
                    </div>
                    <div class="p-4">
                        <form method="POST" action="{{ url('dashboard/project/bmc-studing/'.$project->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="bmc_status" class="form-label">{{ trans('auth/project.bmc_status') }}</label>
                                <select name="bmc_status" id="bmc_status" class="form-control @error('bmc_status') is-invalid @enderror">
                                    <option value="">{{ trans('auth/project.select_bmc_status') }}</option>
                                    <option value="1" @if($project->bmc_status == 1) selected @endif>{{ trans('project.status_project.under_studying') }}</option>
                                    <option value="2" @if($project->bmc_status == 2) selected @endif>{{ trans('project.status_project.bmc_accepted') }}</option>
                                    <option value="3" @if($project->bmc_status == 3) selected @endif>{{ trans('project.status_project.bmc_reformat') }}</option>
                                </select>
                                @error('bmc_status')
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
</div>
@endsection
