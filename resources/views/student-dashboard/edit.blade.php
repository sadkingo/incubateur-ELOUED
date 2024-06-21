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
        <form method="POST" action="{{ route('student.account.update', $studentGroup->id) }}">
            @csrf
            @method('PUT')
            <div id="dynamic-fields">
                <div class="row">
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_ar" class="form-label">{{ trans('auth/student.firstname_ar') }}</label>
                        <input 
                            type="text" 
                            class="form-control @error('firstname_ar') is-invalid @enderror" 
                            name="firstname_ar" 
                            value="{{ old('firstname_ar', $studentGroup->firstname_ar) }}" 
                            required pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط"
                        >
                        @error('inputs.0.firstname_ar')
                        <small class="text-danger d-block mt-1">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_ar" class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                        <input 
                            type="text" 
                            class="form-control @error('lastname_ar') is-invalid @enderror" 
                            name="lastname_ar" 
                            value="{{ old('lastname_ar', $studentGroup->lastname_ar) }}" 
                            required pattern="[\u0600-\u06FF\s]+" title="الرجاء إدخال حروف عربية فقط"
                        >
                        @error('firstname_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="firstname_fr" class="form-label">{{ trans('auth/student.firstname_fr') }}</label>
                        <input type="text" class="form-control @error('firstname_fr') is-invalid @enderror"
                            name="firstname_fr" dir="ltr" value="{{ old('firstname_fr', $studentGroup->firstname_fr) }}" 
                        >
                        @error('firstname_fr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-3 mb-2">
                        <label for="lastname_fr" class="form-label">{{ trans('auth/student.lastname_fr') }}</label>
                        <input type="text" dir="ltr" class="form-control @error('lastname_fr') is-invalid @enderror"
                        name="lastname_fr" dir="ltr" value="{{ old('lastname_fr', $studentGroup->lastname_fr) }}">
                        @error('lastname_fr')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-2 mb-2">
                        <label for="gender" class="form-label">{{ trans('app.label.gender') }}</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                            <option value="">-- {{ trans('app.select_gender') }} --</option>
                            <option value="1" @if($studentGroup->gender == 1) selected @endif>{{ trans('app.male') }}</option>
                            <option value="2" @if($studentGroup->gender == 2) selected @endif>{{ trans('app.female') }}</option>
                        </select>
                        @error('gender')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                <div class="col-sm-12 col-md-2 mb-2">
                    <label for="birthday" class="form-label">{{ trans('app.label.birthday') }}</label>
                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                        value="{{ old('birthday', $studentGroup->birthday) }}">
                    @error('birthday')
                        <small class="text-danger d-block">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                </div>
            </div>
            <div class="col-sm-12 mt-3 d-flex">
                <div class="col d-flex justify-content-end">
                    
                    <button type="submit" class="btn btn-primary">{{ trans('auth/student.edit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection        
