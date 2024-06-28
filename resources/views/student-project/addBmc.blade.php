@extends('layouts/contentNavbarLayout')

@section('title', trans('project.create_project'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ trans('project.dashboard') }} / {{ trans('project.project') }}/ </span>
    {{ trans('project.create_bmc') }}
</h4>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ trans('project.create_bmc') }}</h5>
        <form method="post" action="{{ url('student/project/'.$project->id.'/storeBmc') }}" enctype="multipart/form-data" id="project-form">
            @csrf
            <div id="dynamic-fields">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="bmc" class="form-label">{{ trans('auth/project.bmc') }}</label>
                        <input type="file" dir="ltr" class="form-control @error('bmc') is-invalid @enderror"
                               name="bmc" value="{{ old('bmc') }}"
                               placeholder="{{ trans('auth/project.placeholder.bmc') }}">
                        @error('bmc')
                        <small class="text-danger d-block">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 mt-3 d-flex">
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submit-button">
                                {{ trans('auth/project.accept') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection                   