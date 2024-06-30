@extends('layouts/contentNavbarLayout')

@section('title', trans('supervisor.create'))

@section('page-script')
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ trans('supervisor.dashboard') }} / {{ trans('supervisor.supervisor') }} / </span>
    {{ trans('supervisor.create') }}
</h4>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ trans('supervisor.create') }}</h5>

        <div id="supervisor-list">
            <h6>{{ trans('supervisor.select_supervisor') }}</h6>
            @if($supervisors->isEmpty())
                <p>{{ trans('supervisor.no_supervisors_available') }}</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ trans('auth/student.firstname_ar') }}</th>
                            <th>{{ trans('auth/student.lastname_ar') }}</th>
                            <th>{{ trans('supervisor.speciality') }}</th>
                            <th>{{ trans('supervisor.faculty') }}</th>
                            <th>{{ trans('supervisor.departement') }}</th>
                            <th>{{ trans('supervisor.assign') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supervisors as $supervisor)
                            <tr>
                                <td>{{ $supervisor->firstname_ar }}</td>
                                <td>{{ $supervisor->lastname_ar }}</td>
                                <td>{{ $supervisor->speciality }}</td>
                                <td>{{ $supervisor->faculty }}</td>
                                <td>{{ $supervisor->departement }}</td>
                                <td>
                                    <form method="POST" action="{{ route('student.supervisor.assign', $supervisor->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">{{ trans('supervisor.assign') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        
                <!-- روابط الترقيم -->
                <div class="d-flex justify-content-center">
                    {{ $supervisors->links() }}
                </div>
            @endif
        </div>
        
        <button id="add-supervisor-button" class="btn btn-secondary">{{ trans('supervisor.Add_supervisor') }}</button>

        <div id="add-supervisor-form" style="display:none;">
            <form method="POST" action="{{ route('student.supervisor.store') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_ar" class="form-label">{{ trans('auth/student.firstname_ar') }}</label>
                        <input type="text" class="form-control @error('firstname_ar') is-invalid @enderror" name="firstname_ar" value="{{ old('firstname_ar') }}" required pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط">
                        @error('firstname_ar')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_ar" class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                        <input type="text" class="form-control @error('lastname_ar') is-invalid @enderror" name="lastname_ar" value="{{ old('lastname_ar') }}" required pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط">
                        @error('lastname_ar')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_fr" class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                        <input type="text" class="form-control @error('firstname_fr') is-invalid @enderror" name="firstname_fr" value="{{ old('firstname_fr') }}">
                        @error('firstname_fr')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_fr" class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                        <input type="text" class="form-control @error('lastname_fr') is-invalid @enderror" name="lastname_fr" value="{{ old('lastname_fr') }}">
                        @error('lastname_fr')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="gender" class="form-label">{{ trans('app.label.gender') }}</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                            <option value="">-- {{ trans('app.select_gender') }} --</option>
                            <option value="1">{{ trans('app.male') }}</option>
                            <option value="2">{{ trans('app.female') }}</option>
                        </select>
                        @error('gender')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="phone" class="form-label">{{ trans('auth/student.phone') }}</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="email" class="form-label">{{ trans('auth/student.email') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        @error('email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="speciality" class="form-label">{{ trans('supervisor.speciality') }}</label>
                        <input type="text" class="form-control @error('speciality') is-invalid @enderror" name="speciality" value="{{ old('speciality') }}">
                        @error('speciality')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="faculty" class="form-label">{{ trans('supervisor.faculty') }}</label>
                        <input type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{ old('faculty') }}">
                        @error('faculty')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="departement" class="form-label">{{ trans('supervisor.departement') }}</label>
                        <input type="text" class="form-control @error('departement') is-invalid @enderror" name="departement" value="{{ old('departement') }}">
                        @error('departement')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="grade" class="form-label">{{ trans('supervisor.grade') }}</label>
                        <input type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ old('grade') }}">
                        @error('grade')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="role" class="form-label">{{ trans('supervisor.role') }}</label>
                        <select name="supervisor_role" id="supervisor_role" class="form-control @error('supervisor_role') is-invalid @enderror">
                            <option value="">{{ trans('auth/supertvisor.select_supervisor_role') }}</option>
                            <option value="1">{{ trans('auth/supertvisor.main_supervisor') }}</option>
                            <option value="2">{{ trans('auth/supertvisor.second_supervisor') }}</option>
                            <option value="3">{{ trans('auth/supertvisor.assistant_supervisor') }}</option>
                        </select>
                        @error('supervisor_role')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ trans('supervisor.accept') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('add-supervisor-button').addEventListener('click', function() {
    document.getElementById('supervisor-list').style.display = 'none';
    document.getElementById('add-supervisor-form').style.display = 'block';
});
</script>
@endsection
