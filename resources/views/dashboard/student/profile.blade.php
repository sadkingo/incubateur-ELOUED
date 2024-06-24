@extends('layouts/contentNavbarLayout')

@section('title', trans('student.profile.title'))

@section('content')
<style>

  .description {
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
  }

  body{
      margin-top:20px;
      color: #1a202c;
      text-align: left;
      background-color: #e2e8f0;    
  }
  .main-body {
      padding: 15px;
  }
  .card {
      box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
  }

  .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid rgba(0,0,0,.125);
      border-radius: .25rem;
  }

  .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 1rem;
  }

  .gutters-sm {
      margin-right: -8px;
      margin-left: -8px;
  }

  .gutters-sm>.col, .gutters-sm>[class*=col-] {
      padding-right: 8px;
      padding-left: 8px;
  }
  .mb-3, .my-3 {
      margin-bottom: 1rem!important;
  }

  .bg-gray-300 {
      background-color: #e2e8f0;
  }
  .h-100 {
      height: 100%!important;
  }
  .shadow-none {
      box-shadow: none!important;
  }

  .rowName {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.rowName .colName-sm-3 {
  flex: 0 0 auto;
}
.rowName .colName-sm-9 {
  flex: 1;
    /* تأكد من أن النص يكون إلى اليسار */
    /* إضافة مسافة صغيرة بين العنصرين */
}
</style>
<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          {{-- <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav> --}}
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      @php
                        $locale = app()->getLocale();
                        $name = $locale === 'ar' ? $student->firstname_ar . ' ' . $student->lastname_ar : $student->firstname_fr . ' ' . $student->lastname_fr;
                      @endphp
                    <h4>{{ $name }}</h4>
                      <p class="text-secondary mb-1">{{trans('auth/student.placeholder.gender')}}: @if($student->gender == 1){{trans('student.homme')}} @else {{trans('student.femme')}} @endif</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0 mr-2"><i class="fas fa-graduation-cap "></i>&nbsp;{{trans('auth/student.academicLevel')}}</h6>
                    <span class="text-secondary">{{$student->academicLevel}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fas fa-user-graduate mr-2"></i>&nbsp;{{trans('auth/student.specialty')}}</h6>
                    <span class="text-secondary">{{$student->specialty}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fas fa-university mr-2"></i>&nbsp;{{trans('auth/student.faculty')}}</h6>
                    <span class="text-secondary">{{$student->faculty}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="fas fa-building mr-2"></i>&nbsp;{{trans('auth/student.department')}}</h6>
                    <span class="text-secondary">{{$student->department}}</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{ trans('auth/student.email')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{$student->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{ trans('auth/student.phone')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$student->phone}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{trans('auth/student.birthday')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$student->birthday}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{trans('auth/student.residence')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$student->residence}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{trans('auth/student.batch')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$student->batch}}
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3">
                        <i class="material-icons text-info mr-2">{{trans('student.info_student')}}</i></h6>
                      @if($studentGroups->count() >0)
                        @foreach ($studentGroups as $group)
                          <p>{{$group->firstname_fr}} {{$group->lasttname_fr}}</p>  
                        @endforeach
                      @else
                        <small>{{trans('student.no_students')}}</small>
                      @endif  
                    </div>
                  </div>
                  <div class="card h-100">
                    <div class="card-body"> 
                      <h6 class="d-flex align-items-center mb-3">
                      <i class="material-icons text-info mr-2">{{trans('student.info_project')}}</i></h6>
                      @if($project != null)
                        <small>{{trans('project.label.name')}}: {{$project->name}}</small>
                        <p class="description">{{trans('project.label.description')}}: {{$project->description}}</p>  
                      @else
                        <small>{{trans('student.no_project')}}</small>
                      @endif  
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">{{trans('student.info_prjt')}}</i></h6>
                      @if($student->project_stage != null)
                        <small>{{ trans('student.project_stage') }}: {{ $stageInfo['name'] }} ({{ $stageInfo['percentage'] }}%)</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $stageInfo['percentage'] }}%" aria-valuenow="{{ $stageInfo['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      @else
                        <small>{{ trans('student.no_supervisor') }}</small>
                      @endif
                      <a class="btn btn-primary" href="{{ url('/dashboard/students/' . $student->id . '/edit-stage') }}">
                        {{ trans('student.edit_stage') }}
                    </a>
                    
                    </div>
                  </div>
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">{{trans('student.info_supervisor')}}</i></h6>
                      @if($supervisors->count() > 0)
                        @foreach ($supervisors as $supervisor)
                          <div class="rowName">
                            <div class="col-sm-3">
                              <h6 >{{trans('student.nameSupervisor')}}:</h6>
                            </div>
                            <div class="colName-sm-9 text-secondary">
                              {{$supervisor->firstname_fr}} {{$supervisor->lastname_fr}}
                            </div>
                          </div>  
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">{{trans('auth/student.faculty')}}:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              {{$supervisor->faculty}}
                            </div>
                          </div>  
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">{{trans('auth/student.department')}}:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              {{$supervisor->departement}}
                            </div>
                          </div>  
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">{{trans('auth/student.specialty')}}:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              {{$supervisor->speciality}}
                            </div>
                          </div>  
                          <hr>
                        @endforeach
                      @else
                        <small>{{trans('student.no_supervisor')}}</small>
                      @endif    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
<script>
      document.getElementById('editStageBtn').addEventListener('click', function () {
          Swal.fire({
              title: '{{ trans('student.edit_stage') }}',
              input: 'select',
              inputOptions: {
                  1: '{{ trans('student.business_model_preparation') }}',
                  2: '{{ trans('student.prototype_development') }}',
                  3: '{{ trans('student.startup_dz_registration') }}',
                  4: '{{ trans('student.discussion') }}'
              },
              inputPlaceholder: '{{ trans('student.select_stage') }}',
              showCancelButton: true,
              inputValidator: function (value) {
                  return new Promise(function (resolve, reject) {
                      if (value) {
                          resolve();
                      } else {
                          reject('{{ trans('student.select_stage_error') }}');
                      }
                  });
              }
          }).then(function (result) {
              if (result.isConfirmed) {
                  // إرسال المرحلة الجديدة إلى الخادم لتحديثها
                  updateProjectStage(result.value);
              }
          });
      });
      
      function updateProjectStage(stage) {
          fetch('{{ url("/students/" . $student->id . "/updateStage") }}', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                  stage: stage
              })
          }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: '{{ trans('student.update_success') }}',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: '{{ trans('student.update_error') }}',
                        icon: 'error'
                    });
                }
            });
      }
</script>    
@endsection
