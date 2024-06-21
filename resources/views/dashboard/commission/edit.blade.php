@extends('layouts/contentNavbarLayout')

@section('title', trans('commission.edit'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('commission.dashboard') }} / {{ trans('commission.commission') }}/ </span>
        {{ trans('commission.edit') }}
    </h4>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('commission.edit') }}</h5>
            <form method="post" action="{{ url('dashboard/commission/' . $commission->id) }}">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $commission->id }}">
                <div class="row">
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="name_ar" class="form-label text-end">{{ trans('app.label.name_ar') }}</label>
                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                            name="name_ar" value="{{ old('name_ar', $commission->name_ar) }}"
                            placeholder="{{ trans('app.placeholder.name_ar') }}">
                        @error('name_ar')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="name_fr" class="form-label">{{ trans('app.label.name_fr') }}</label>
                        <input type="text" class="form-control @error('name_fr') is-invalid @enderror"
                            name="name_fr" dir="ltr" value="{{ old('name_fr', $commission->name_fr) }}"
                            placeholder="{{ trans('app.placeholder.name_fr') }}">
                        @error('name_fr')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 mt-3 d-flex">
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">{{ trans('app.update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
