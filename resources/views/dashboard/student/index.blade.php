@extends('layouts/contentNavbarLayout')

@section('title', trans('student.edit'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('student.dashboard') }} / {{ trans('student.students') }}/ </span>
        {{ trans('student.edit') }}
    </h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('student.edit') }}</h5>
            <form id="editStudentForm" method="POST" action="{{ route('dashboard.student.update') }}">
                {{-- @method('PUT') --}}
                @csrf
                <input type="hidden" name="id" value="{{ $student->id }}">
                <div class="row ">
                    <div class="col-sm-12 col-md-3 mb-2 ">
                        <label for="firstname_ar"
                            class="form-label text-end">{{ trans('auth/student.firstname_ar') }}</label>
                        <input type="text" class="form-control @error('firstname_ar') is-invalid @enderror"
                            name="firstname_ar" value="{{ $student->firstname_ar }}"
                            placeholder="{{ trans('auth/student.placeholder.firstname_ar') }}">
                        @error('firstname_ar')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_ar" class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                        <input type="text" class="form-control @error('lastname_ar') is-invalid @enderror"
                            name="lastname_ar" value="{{ $student->lastname_ar }}"
                            placeholder="{{ trans('auth/student.placeholder.lastname_ar') }}">
                        @error('lastname_ar')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_fr" class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                        <input type="text" class="form-control @error('firstname_fr') is-invalid @enderror"
                            name="firstname_fr" dir="ltr" value="{{ $student->firstname_fr }}"
                            placeholder="{{ trans('auth/student.placeholder.firstname_fr') }}">
                        @error('firstname_fr')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_fr" class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                        <input type="text" dir="ltr" class="form-control @error('lastname_fr') is-invalid @enderror"
                            name="lastname_fr" value="{{ $student->lastname_fr }}"
                            placeholder="{{ trans('auth/student.placeholder.lastname_fr') }}">
                        @error('lastname_fr')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="gender" class="form-label">{{ trans('app.label.gender') }}</label>
                        <select class="form-select @error('gender') is-invalid @enderror"
                            name="gender" value="{{ $student->gender }}">
                            <option value="1" {{ $student->gender == 1 ? 'selected' : '' }}>{{ trans('app.male') }}</option>
                            <option value="2" {{ $student->gender == 2 ? 'selected' : '' }}>{{ trans('app.female') }}</option>
                        </select>
                        @error('gender')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="birthday" class="form-label">{{ trans('app.label.birthday') }}</label>
                        <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                            value="{{ $student->birthday }}">
                        @error('birthday')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="state_of_birth" class="form-label">{{ trans('app.label.state_of_birth') }}</label>
                        <input type="text" class="form-control @error('state_of_birth') is-invalid @enderror"
                            name="state_of_birth" value="{{ $student->state_of_birth }}"
                            placeholder="{{ trans('app.placeholder.state_of_birth') }}">
                        @error('state_of_birth')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="place_of_birth" class="form-label">{{ trans('app.label.place_of_birth') }}</label>
                        <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror"
                            name="place_of_birth" value="{{ $student->place_of_birth }}"
                            placeholder="{{ trans('app.placeholder.place_of_birth') }}">
                        @error('place_of_birth')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="registration_number"
                            class="form-label">{{ trans('app.label.registration_number') }}</label>
                        <input type="text" class="form-control @error('registration_number') is-invalid @enderror"
                            name="registration_number" value="{{ $student->registration_number }}"
                            placeholder="{{ trans('app.placeholder.registration_number') }}">
                        @error('registration_number')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="group" class="form-label">{{ trans('app.label.group') }}</label>
                        <input type="text" class="form-control @error('group') is-invalid @enderror" name="group"
                            value="{{ $student->group }}" placeholder="{{ trans('app.placeholder.group') }}">
                        @error('group')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="faculty" class="form-label">{{ trans('manager.label.faculty') }}</label>
                        <select class="form-select" name="faculty" required>
                            <option value="">{{ trans('manager.select.faculty') }}</option>
                            @foreach ($facultys as $faculty)
                                @if ($faculty->id == $student->faculty->id)
                                    <option value="{{ $faculty->id }}" selected>{{ $faculty->name_ar }}</option>
                                @else
                                    <option value="{{ $faculty->id }}">{{ $faculty->name_ar }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('faculty')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                        {{-- <label for="faculty"
                            class="form-label">{{ trans('auth/student.faculty') }}</label>
                        <input type="text" class="form-control @error('faculty') is-invalid @enderror"
                            name="faculty" value="{{ $student->faculty->name_ar }}"
                            placeholder="{{ trans('app.placeholder.faculty') }}">
                        @error('faculty')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror --}}
                    </div>

                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="specialty" class="form-label">{{ trans('auth/student.specialty') }}</label>
                        <input type="text" class="form-control @error('specialty') is-invalid @enderror" name="specialty"
                            value="{{ $student->specialty }}" placeholder="{{ trans('app.placeholder.specialty') }}">
                        @error('specialty')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="email" class="form-label">{{ trans('app.label.email') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $student->email }}" placeholder="{{ trans('app.placeholder.email') }}">
                        @error('email')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="phone" class="form-label">{{ trans('app.label.phone') }}</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ $student->phone }}" placeholder="{{ trans('app.placeholder.phone') }}">
                        @error('phone')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    {{-- <div class="col-sm-12 col-md-6 mb-2">
                        <label for="password" class="form-label">{{ trans('app.label.password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password">
                        @error('password')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label for="password_confirmation"
                            class="form-label">{{ trans('app.label.confirme_password') }}</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation">
                        @error('password_confirmation')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div> --}}

                    <div class="col-sm-12 mt-3 d-flex">
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">{{ trans('app.update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script>
      $(document).ready(function() {
        $('#editStudentForm').submit(function(event) {
          event.preventDefault();

          var formData = $(this).serialize();

          $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            dataType: 'json',
            success: function(response) {
              Swal.fire({
                icon: response.icon,
                title: response.state,
                text: response.message,
                confirmButtonText: "Ok"
              });          },
            error: function(xhr, textStatus, errorThrown) {
              const response = JSON.parse(xhr.responseText);
              Swal.fire({
                icon: response.icon,
                title: response.state,
                text: response.message,
                confirmButtonText: "Ok"
              });
            }
          });
        });

      });
  </script>

@endsection
