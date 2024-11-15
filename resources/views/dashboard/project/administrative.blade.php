@extends('layouts/contentNavbarLayout')

@section('title', trans('project.create_project'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<style>
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .loading-overlay.show {
        display: flex;
    }
</style>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ trans('project.dashboard') }} / {{ trans('project.project') }}/ </span>
    {{ trans('auth/project.administrative') }}
</h4>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ trans('auth/project.add_administrative') }}</h5>
        <form method="post" action="{{ url('project/administrative/'.$project->id.'/store') }}" enctype="multipart/form-data" id="project-form">
            @csrf
            <div id="dynamic-fields">
                @foreach ($group as $student)
                    @php
                        $locale = app()->getLocale();
                        $nameStudent = $locale === 'ar' ? $student->student->firstname_ar . ' ' . $student->student->lastname_ar : $student->student->firstname_fr . ' ' . $student->student->lastname_fr;
                    @endphp
                    <div class="row">
                        <div class="col-12 mb-2">
                            <h6></h6>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="registration_certificate" class="form-label">{{ trans('auth/project.registration_certificate') }}: {{ $nameStudent }}</label>
                            <input type="file" class="form-control @error('registration_certificate') is-invalid @enderror"
                                  name="registration_certificate[]" value="{{ old('registration_certificate') }}"
                                  placeholder="{{ trans('auth/project.placeholder.registration_certificate') }}">
                            @error('registration_certificate')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="identification_card" class="form-label">{{ trans('auth/project.identification_card') }}: {{ $nameStudent }}</label>
                            <input type="file" class="form-control @error('identification_card') is-invalid @enderror"
                                  name="identification_card[]" value="{{ old('identification_card') }}"
                                  placeholder="{{ trans('auth/project.placeholder.identification_card') }}">
                            @error('identification_card')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="photo" class="form-label">{{ trans('auth/project.photo') }}: {{ $nameStudent }}</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                   name="photo[]" value="{{ old('photo') }}"
                                   placeholder="{{ trans('auth/project.placeholder.photo') }}">
                            @error('photo')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                @endforeach
                <div class="col-sm-12 mt-3 d-flex">
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="submit-button">
                            {{ trans('auth/project.accept') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
