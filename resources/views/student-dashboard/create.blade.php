@extends('layouts/contentNavbarLayout')

@section('title', trans('student.create'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ trans('student.dashboard') }} / {{ trans('student.students') }}/ </span>
    {{ trans('student.create') }}
</h4>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('student.create') }}</h5>
            <form method="POST" action="{{ route('student.account.store') }}">
                @csrf
                <div id="dynamic-fields">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="firstname_ar" class="form-label">{{ trans('auth/student.firstname_ar') }}</label>
                            <input type="text" class="form-control @error('firstname_ar') is-invalid @enderror"
                                   name="inputs[0][firstname_ar]" value="{{ old('inputs.0.firstname_ar') }}"
                                   placeholder="{{ trans('auth/student.placeholder.firstname_ar') }}"
                                   pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط">
                            @error('inputs.0.firstname_ar')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="lastname_ar" class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                            <input type="text" class="form-control @error('lastname_ar') is-invalid @enderror"
                                   name="inputs[0][lastname_ar]" value="{{ old('inputs.0.lastname_ar') }}"
                                   placeholder="{{ trans('auth/student.placeholder.lastname_ar') }}"
                                   pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط">
                            @error('inputs.0.lastname_ar')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="firstname_fr" class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                            <input type="text" class="form-control @error('firstname_fr') is-invalid @enderror"
                                name="inputs[0][firstname_fr]" dir="ltr" value="{{ old('inputs.0.firstname_fr') }}"
                                placeholder="{{ trans('auth/student.placeholder.firstname_fr') }}">
                            @error('inputs.0.firstname_fr')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="lastname_fr" class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                            <input type="text" dir="ltr" class="form-control @error('lastname_fr') is-invalid @enderror"
                                name="inputs[0][lastname_fr]" value="{{ old('inputs.0.lastname_fr') }}"
                                placeholder="{{ trans('auth/student.placeholder.lastname_fr') }}">
                            @error('inputs.0.lastname_fr')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-2 mb-2">
                            <label for="gender" class="form-label">{{ trans('app.label.gender') }}</label>
                            <select class="form-select @error('gender') is-invalid @enderror"
                                name="inputs[0][gender]" value="{{ old('inputs.0.gender') }}">
                                <option value="" selected>-- {{ trans('app.select_gender') }} --</option>
                                <option value="1">{{ trans('app.male') }}</option>
                                <option value="2">{{ trans('app.female') }}</option>
                            </select>
                            @error('inputs.0.gender')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-2 mb-2">
                            <label for="birthday" class="form-label">{{ trans('app.label.birthday') }}</label>
                            <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="inputs[0][birthday]"
                                value="{{ old('inputs.0.birthday') }}">
                            @error('inputs.0.birthday')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-2 mb-2">
                            <label for="place_of_birth" class="form-label">{{ trans('app.label.place_of_birth') }}</label>
                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="inputs[0][place_of_birth]"
                                value="{{ old('inputs.0.place_of_birth') }}">
                            @error('inputs.0.place_of_birth')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="registration_number"
                                class="form-label">{{ trans('auth/student.registration_number') }}</label>
                            <input type="text"
                                class="form-control registration_number @error('registration_number') is-invalid @enderror"
                                name="inputs[0][registration_number]" value="{{ old('inputs.0.registration_number') }}"
                                placeholder="{{ trans('auth/student.placeholder.registration_number') }}">
                            @error('inputs.0.registration_number')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="academicLevel" class="form-label">
                                {{ trans('auth/student.academicLevel') }}
                            </label>
                            <select  
                                id="academicLevel" 
                                class="form-control @error('academicLevel') is-invalid @enderror" 
                                name="inputs[0][academicLevel]" value="{{ old('inputs.0.academicLevel') }}">
                                <option value="0">{{trans('auth/student.specialties.select')}}</option>
                                <option value="bachelor">{{ trans('auth/student.specialties.bachelor') }}</option>
                                <option value="master">{{ trans('auth/student.specialties.master') }}</option>
                                <option value="phd">{{ trans('auth/student.specialties.phd') }}</option>
                            </select> 
                            @error('inputs.0.academicLevel')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="specialty"
                                class="form-label">{{ trans('auth/student.specialty') }}</label>
                            <input type="text"
                                class="form-control specialty @error('specialty') is-invalid @enderror" name="inputs[0][specialty]"
                                value="{{ old('inputs.0.specialty') }}"
                                placeholder="{{ trans('auth/student.placeholder.specialty') }}">
                            @error('inputs.0.specialty')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="id_faculty" class="form-label">{{ trans('auth/student.faculty') }}</label>
                            <select class="form-select" id="id_faculty" name="inputs[0][id_faculty]" value="{{ old('inputs.0.id_faculty') }}">
                                <option value="">{{trans('auth/student.select.faculty')}}</option>
                                @foreach ($faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('inputs.0.id_faculty')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror        
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="id_department" class="form-label">{{ trans('auth/student.department') }}</label>
                            <select class="form-select" id="id_department" name="inputs[0][id_department]" value="{{ old('inputs.0.id_department') }}">
                                <option value="">{{trans('auth/student.select.department')}}</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}" >{{$department->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('inputs.0.id_department')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 mt-3 d-flex">
                    <div class="col d-flex justify-content-end">
                        <button type="button" name="add" id="add" class="btn btn-success me-4">{{ trans('app.label.action') }}</button>
                        <button type="submit" class="btn btn-primary ">{{ trans('auth/student.accept') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function() {
            $("#add").click(function() {
                var index = $("#dynamic-fields .row").length;
                var newFields = 
                `
                    <div class="row">
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="firstname_ar" class="form-label">{{ trans('auth/student.firstname_ar') }}</label>
                            <input type="text" class="form-control @error('firstname_ar') is-invalid @enderror" name="inputs[${index}][firstname_ar]" value="{{ old('inputs.0.firstname_ar') }}" placeholder="{{ trans('auth/student.placeholder.firstname_ar') }}">
                            @error('inputs.0.firstname_ar')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="lastname_ar" class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                            <input type="text" class="form-control @error('lastname_ar') is-invalid @enderror" name="inputs[${index}][lastname_ar]" value="{{ old('inputs.0.lastname_ar') }}" placeholder="{{ trans('auth/student.placeholder.lastname_ar') }}">
                            @error('inputs.0.lastname_ar')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="firstname_fr" class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                            <input type="text" class="form-control  @error('firstname_fr') is-invalid @enderror" name="inputs[${index}][firstname_fr]"  value="{{ old('inputs.0.firstname_fr') }}" placeholder="{{ trans('auth/student.placeholder.firstname_fr') }}">
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="lastname_fr" class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                            <input type="text" dir="ltr" class="form-control @error('lastname_fr') is-invalid @enderror" name="inputs[${index}][lastname_fr]" value="{{ old('inputs.0.lastname_fr') }}" placeholder="{{ trans('auth/student.placeholder.lastname_fr') }}">
                            @error('inputs.0.lastname_fr')
                                    <small class="text-danger d-block">
                                        {{ $message }}
                                    </small>
                                @enderror
                        </div>
                        <div class="col-sm-12 col-md-2 mb-2">
                            <label for="gender" class="form-label">{{ trans('app.label.gender') }}</label>
                            <select class="form-select @error('gender') is-invalid @enderror" name="inputs[${index}][gender]" value="{{ old('inputs.0.gender') }}">
                                <option value="" selected>-- {{ trans('app.select_gender') }} --</option>
                                <option value="1">{{ trans('app.male') }}</option>
                                <option value="2">{{ trans('app.female') }}</option>
                            </select>
                            @error('inputs.0.gender')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-2 mb-2">
                            <label for="birthday" class="form-label">{{ trans('app.label.birthday') }}</label>
                            <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="inputs[${index}][birthday]" value="{{ old('inputs.0.birthday') }}">
                            @error('inputs.0.birthday')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                        
                                @enderror
                        </div>
                        <div class="col-sm-12 col-md-2 mb-2">
                            <label for="place_of_birth" class="form-label">{{ trans('app.label.place_of_birth') }}</label>
                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="inputs[${index}][place_of_birth]" value="{{ old('inputs.0.place_of_birth') }}">
                            @error('inputs.0.place_of_birth')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                        
                                @enderror
                        </div>
                        
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="registration_number"
                                class="form-label">{{ trans('auth/student.registration_number') }}</label>
                            <input type="text"
                                class="form-control registration_number @error('registration_number') is-invalid @enderror"
                                name="inputs[${index}][registration_number]" value="{{ old('inputs.0.registration_number') }}"
                                placeholder="{{ trans('auth/student.placeholder.registration_number') }}">
                            @error('inputs.0.registration_number')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="academicLevel" class="form-label">
                                {{ trans('auth/student.academicLevel') }}
                            </label>
                            <select name="inputs[${index}][academicLevel]" id="academicLevel" class="form-control @error('academicLevel' ) is-invalid @enderror" value="{{ old('inputs.0.academicLevel') }}">
                                <option value="0">{{trans('auth/student.specialties.select')}}</option>
                                <option value="bachelor">{{ trans('auth/student.specialties.bachelor') }}</option>
                                <option value="master">{{ trans('auth/student.specialties.master') }}</option>
                                <option value="phd">{{ trans('auth/student.specialties.phd') }}</option>
                            </select> 
                            @error('inputs.0.academicLevel')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="specialty"
                                class="form-label">{{ trans('auth/student.specialty') }}</label>
                            <input type="text"
                                class="form-control specialty @error('specialty') is-invalid @enderror" name="inputs[${index}][specialty]"
                                value="{{ old('inputs.0.specialty') }}"
                                placeholder="{{ trans('auth/student.placeholder.specialty') }}">
                            @error('inputs.0.specialty')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="id_faculty" class="form-label">{{ trans('auth/student.faculty') }}</label>
                            <select class="form-select" id="id_faculty" name="inputs[${index}][id_faculty]" value="{{ old('inputs.0.id_faculty') }}">
                                <option value="">{{trans('auth/student.select.faculty')}}</option>
                                @foreach ($faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('inputs.0.id_faculty')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label for="id_department" class="form-label">{{ trans('auth/student.department') }}</label>
                            <select class="form-select" id="id_department" name="inputs[${index}][id_department]" value="{{ old('inputs.0.id_department') }}">
                                <option value="">{{trans('auth/student.select.department')}}</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}" >{{$department->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('inputs.0.id_department')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                `;
            $(newFields).appendTo("#dynamic-fields");
        });
    });

</script>
@endsection
