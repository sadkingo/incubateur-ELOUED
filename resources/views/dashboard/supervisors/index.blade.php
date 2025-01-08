@extends('layouts/contentNavbarLayout')

@section('title', trans('supervisor.edit'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('manager.dashboard') }} / {{ trans('supervisor.supervisors') }}/ </span>
        {{ trans('supervisor.edit') }}
    </h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('supervisor.edit') }}</h5>
            <form id="editSupervisorForm" method="POST" action="{{ route('supervisors.update', $supervisor->id) }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_ar" class="form-label">{{ trans('auth/student.firstname_ar') }}</label>
                        <input type="text" class="form-control @error('firstname_ar') is-invalid @enderror" name="firstname_ar" value="{{ $supervisor->firstname_ar }}" required pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط">
                        @error('firstname_ar')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_ar" class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                        <input type="text" class="form-control @error('lastname_ar') is-invalid @enderror" name="lastname_ar" value="{{ $supervisor->lastname_ar }}" required pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط">
                        @error('lastname_ar')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_fr" class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                        <input type="text" class="form-control @error('firstname_fr') is-invalid @enderror" name="firstname_fr" value="{{ $supervisor->firstname_fr }}">
                        @error('firstname_fr')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_fr" class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                        <input type="text" class="form-control @error('lastname_fr') is-invalid @enderror" name="lastname_fr" value="{{ $supervisor->lastname_fr }}">
                        @error('lastname_fr')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="gender" class="form-label">{{ trans('app.label.gender') }}</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                <option value="" @if ($supervisor->gender == null) selected  @endif>-- {{ trans('app.select_gender') }} --</option>
                                <option value="1" @if ($supervisor->gender == 1) selected  @endif>{{ trans('app.male') }}</option>
                                <option value="2" @if ($supervisor->gender == 2) selected  @endif>{{ trans('app.female') }}</option>
                        </select>
                        @error('gender')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="phone" class="form-label">{{ trans('auth/student.phone') }}</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $supervisor->phone }}">
                        @error('phone')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="email" class="form-label">{{ trans('auth/student.email') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $supervisor->email }}">
                        @error('email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="speciality" class="form-label">{{ trans('supervisor.speciality') }}</label>
                        <input type="text" class="form-control @error('speciality') is-invalid @enderror" name="speciality" value="{{ $supervisor->speciality }}">
                        @error('speciality')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="faculty_id" class="form-label">{{ trans('auth/student.faculty') }}</label>
                        <select class="form-select" id="faculty_id" name="faculty_id" value="{{ $supervisor->faculty_id }}">
                            <option value="">{{trans('auth/student.select.faculty')}}</option>
                            @foreach ($faculties as $faculty)
                                <option value="{{$faculty->id}}" {{ $supervisor->faculty_id == $faculty->id ? 'selected' : '' }}>{{$faculty->name_ar}}</option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="department" class="form-label">{{ trans('auth/student.department') }}</label>
                        <select class="form-select" id="departement_id" name="departement_id" value="{{ $supervisor->departement_id }}">
                            <option value="" @if($supervisor->departement_id == null) selected @endif>{{trans('auth/student.select.department')}}</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}" @if($supervisor->departement_id == $department->id) selected @endif>{{$department->name_ar}}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="grade" class="form-label">{{ trans('supervisor.grade') }}</label>
                        <input type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ $supervisor->grade }}">
                        @error('grade')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="col-sm-12 col-md-3 mb-2">
                        <label for="role" class="form-label">{{ trans('supervisor.role') }}</label>
                        <select name="supervisor_role" id="supervisor_role" class="form-control @error('supervisor_role') is-invalid @enderror">
                            <option value="" @if ($supervisor->role == null) selected @endif>{{ trans('auth/supertvisor.select_supervisor_role') }}</option>
                            <option value="1" @if ($supervisor->role == 1) selected @endif>{{ trans('auth/supertvisor.main_supervisor') }}</option>
                            <option value="2" @if ($supervisor->role == 2) selected @endif>{{ trans('auth/supertvisor.second_supervisor') }}</option>
                            <option value="3" @if ($supervisor->role == 3) selected @endif>{{ trans('auth/supertvisor.assistant_supervisor') }}</option>
                        </select>
                        @error('supervisor_role')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div> --}}
                </div>
                <div class="col-sm-12 mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ trans('supervisor.accept') }}</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#faculty_id').on('change', function () {
                let facultyId = $(this).val(); // Get selected faculty ID
                
                // Clear existing departments
                $('#departement_id').empty().append('<option value="">{{ trans('auth/student.select.department') }}</option>');
    
                if (facultyId) {
                    $.ajax({
                        url: '/dashboard/get-departments/' + facultyId, // Endpoint to fetch departments
                        type: 'GET',
                        success: function (departments) {
                            $.each(departments, function (key, department) {
                                $('#departement_id').append(
                                    `<option value="${department.id}">${department.name_ar}</option>`
                                );
                            });
                        },
                        error: function () {
                            alert('{{ trans('auth/student.error.fetch_departments') }}');
                        }
                    });
                }
            });
        });
    </script>
    
@endsection
