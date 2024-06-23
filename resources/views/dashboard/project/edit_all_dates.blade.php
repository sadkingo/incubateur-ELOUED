@extends('layouts/contentNavbarLayout')

@section('title', 'إدخال تواريخ تعديل المشاريع')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ trans('project.add_deadline') }}</h5>
        <form action="{{ route('dashboard.projects.update_all_dates') }}" method="POST">
            @csrf
            <div id="dynamic-fields">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="start_date" class="form-label">{{ trans('auth/project.start_date') }}</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                               name="start_date" value="{{ old('start_date') }}"
                               placeholder="{{ trans('auth/project.placeholder.start_date') }}">
                        @error('start_date')
                        <small class="text-danger d-block mt-1">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="end_date" class="form-label">{{ trans('auth/project.end_date') }}</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                               name="end_date" value="{{ old('end_date') }}"
                               placeholder="{{ trans('auth/project.placeholder.end_date') }}">
                        @error('end_date')
                        <small class="text-danger d-block mt-1">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    
                    
                    
                    
                </div>
            </div>
            <div class="col-sm-12 mt-3 d-flex">
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="submit-button">
                        {{ trans('auth/project.accept') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>    
@endsection
