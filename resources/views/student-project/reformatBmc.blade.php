@extends('layouts/contentNavbarLayout')

@section('title', trans('project.create_project'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ trans('project.dashboard') }} / {{ trans('project.project') }}/ </span>
    {{ trans('project.update_bmc') }}
</h4>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ trans('project.update_bmc') }}</h5>
                <h3>{{trans('project.reformat_BMC')}} {{ $project->name }}</h3>
                <form action="{{ url('student/project/' . $project->id . '/reformatBmc') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="bmc">{{trans('project.upload_BMC')}}</label>
                        <input type="file" class="form-control" id="bmc" name="bmc" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">{{trans('project.update_bmc')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
