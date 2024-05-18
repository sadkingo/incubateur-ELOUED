@extends('layouts/contentNavbarLayout')

@section('title', trans('project.create_project'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('project.dashboard') }} / {{ trans('project.project') }}/ </span>
        {{ trans('project.create_project') }}
    </h4>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('project.create_project') }}</h5>
            <form method="post" action="{{ route('student.project.store') }}" enctype="multipart/form-data">
                @csrf
                <div id="dynamic-fields">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="name_project" class="form-label">{{ trans('auth/project.name_project') }}</label>
                            <input type="text" class="form-control @error('name_project') is-invalid @enderror"
                                   name="name_project" value="{{ old('name_project') }}"
                                   placeholder="{{ trans('auth/project.placeholder.name_project') }}">
                            @error('name_project')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="description" class="form-label">{{ trans('auth/project.description_project') }}</label>
                            <textarea name="description" id="description" cols="30" rows="10"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            <div id="description_count" class="small text-muted">
                                {{ trans('project.characters_remaining') }}: <span id="chars_left">5000</span>
                            </div>
                            @error('description')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="project_image" class="form-label">{{ trans('auth/project.project_images') }}</label>
                            <input type="file" class="form-control @error('project_image.*') is-invalid @enderror"
                                   name="project_image[]" dir="ltr" multiple
                                   placeholder="{{ trans('auth/project.placeholder.project_image') }}">
                            @error('project_image.*')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="video" class="form-label">{{ trans('auth/project.project_video') }}</label>
                            <input type="file" dir="ltr" class="form-control @error('video') is-invalid @enderror"
                                   name="video" value="{{ old('video') }}"
                                   placeholder="{{ trans('auth/project.placeholder.video') }}">
                            @error('video')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
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
                    </div>
                </div>
                <div class="col-sm-12 mt-3 d-flex">
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">{{ trans('auth/project.accept') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const description = document.getElementById('description');
            const charsLeft = document.getElementById('chars_left');
            const descriptionCount = document.getElementById('description_count');
            const maxChars = 5000;
    
            description.addEventListener('input', function () {
                const remaining = maxChars - description.value.length;
                charsLeft.textContent = remaining;
                if (remaining < 0) {
                    descriptionCount.classList.add('text-danger');
                } else {
                    descriptionCount.classList.remove('text-danger');
                }
            });
        });
    </script>
@endsection

@push('scripts')


@endpush
