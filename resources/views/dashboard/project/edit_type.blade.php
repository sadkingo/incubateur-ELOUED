@extends('layouts.contentNavbarLayout')

@section('title', trans('commission.add_commission'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">تعديل نوع المشروع لـ {{ $project->name }}</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ url('dashboard/project/'.$project->id.'/edit-type') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="project_type" class="form-label">{{ trans('auth/project.project_type') }}</label>
                                <select name="project_type" id="project_type" class="form-control @error('project_type') is-invalid @enderror">
                                    <option value="">{{ trans('auth/project.select_project_type') }}</option>
                                    <option value="commercial" @if($project->type_project == 'commercial') selected @endif>{{ trans('auth/project.project_commercial') }}</option>
                                    <option value="industrial" @if($project->type_project == 'industrial') selected @endif>{{ trans('auth/project.project_industrial') }}</option>
                                    <option value="agricultural" @if($project->type_project == 'agricultural') selected @endif>{{ trans('auth/project.project_agricultural') }}</option>
                                    <option value="service" @if($project->type_project == 'service') selected @endif>{{ trans('auth/project.project_service') }}</option>
                                </select>
                                @error('project_type')
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