@extends('layouts.contentNavbarLayout')

@section('title', trans('commission.add_commission'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('commission.add_commission') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.projects.store_commission', $project->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="commission_id">{{ trans('commission.commission') }}</label>
                            <select id="commission_id" name="commission_id" class="form-control">
                                @foreach($commissions as $commission)
                                    <option value="{{ $commission->id }}">{{ $commission->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('commission.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
