@extends('layouts/contentNavbarLayout')

@section('title', trans('student.profile_title'))

@section('content')
    <style>
        .description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
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

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
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

        }
    </style>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                    <div class="avatar-container">
                                      <img src="{{ $student->photoUrl() && $student->photoPath() ? $student->photoUrl() : asset('assets/img/avatars/default.png') }}" alt="" class="rounded-circle avatar-image" width="150" height="150">
                                      <span class="edit-icon mdi mdi-pencil text-secondary" data-bs-toggle="modal" data-bs-target="#uploadModal"></span>
                                    </div>
                                <div class="mt-3">
                                    @php
                                        $locale = app()->getLocale();
                                        $name =
                                            $locale === 'ar'
                                                ? $student->firstname_ar . ' ' . $student->lastname_ar
                                                : $student->firstname_fr . ' ' . $student->lastname_fr;
                                    @endphp
                                    <h4>{{ $name }}</h4>
                                    <p class="text-secondary mb-1">{{ trans('auth/student.placeholder.gender') }}:
                                        @if ($student->gender == 1)
                                            {{ trans('student.homme') }}
                                        @else
                                            {{ trans('student.femme') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 mr-2"><i
                                        class="fas fa-graduation-cap "></i>&nbsp;{{ trans('auth/student.academicLevel') }}
                                </h6>
                                <span class="text-secondary">{{ $student->academicLevel }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i
                                        class="fas fa-user-graduate mr-2"></i>&nbsp;{{ trans('auth/student.specialty') }}
                                </h6>
                                <span class="text-secondary">{{ $student->specialty }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i
                                        class="fas fa-university mr-2"></i>&nbsp;{{ trans('auth/student.faculty') }}</h6>
                                <span class="text-secondary">
                                    @php
                                        $locale = app()->getLocale();
                                        $name =
                                            $locale === 'ar'
                                                ? $faculty->name_ar
                                                : $faculty->name_fr ;
                                    @endphp
                                    {{ $name }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i
                                        class="fas fa-building mr-2"></i>&nbsp;{{ trans('auth/student.department') }}</h6>
                                <span class="text-secondary">{{ $student->department }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('auth/student.email') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('auth/student.phone') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->phone }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('auth/student.birthday') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->birthday }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('auth/student.residence') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->residence }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('auth/student.batch') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->batch }}
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
                                        <i class="material-icons text-info mr-2">{{ trans('student.info_student') }}</i>
                                    </h6>
                                    @if ($studentGroups && $studentGroups->count() > 0)
                                        @foreach ($studentGroups as $group)
                                            @php
                                              $locale = app()->getLocale();
                                              $name =
                                              $locale === 'ar'
                                                ? $group->firstname_ar . ' ' . $group->lastname_ar
                                                : $group->firstname_fr . ' ' . $group->lastname_fr;
                                            @endphp
                                            <p>{{ $name}} </p>
                                        @endforeach
                                    @else
                                        <small>{{ trans('student.no_students') }}</small>
                                    @endif
                                </div>
                                <div class="card-body">
                                  <h6 class="d-flex align-items-center mb-3">
                                      <i class="material-icons text-info mr-2">{{ trans('student.info_project') }}</i>
                                  </h6>
                                  @if ($project != null)
                                      <small>{{ trans('project.label.name') }}: {{ $project->name }}</small>
                                      <p class="description">{{ trans('project.label.description') }}:
                                          {{ $project->description }}</p>
                                  @else
                                      <small>{{ trans('student.no_project') }}</small>
                                  @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i
                                            class="material-icons text-info mr-2">{{ trans('student.info_prjt') }}</i></h6>
                                    @if ($student->project_stage != null)
                                        <small>{{ trans('student.project_stage') }}: {{ $stageInfo['name'] }}
                                            ({{ $stageInfo['percentage'] }}%)</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $stageInfo['percentage'] }}%"
                                                aria-valuenow="{{ $stageInfo['percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    @else
                                        <small>{{ trans('student.no_supervisor') }}</small>
                                    @endif
                                    <a class="btn btn-primary"
                                        href="{{ url('/dashboard/students/' . $student->id . '/edit-stage') }}">
                                        {{ trans('student.edit_stage') }}
                                    </a>

                                </div>
                                <div class="card-body">
                                  <h6 class="d-flex align-items-center mb-3"><i
                                          class="material-icons text-info mr-2">{{ trans('student.info_supervisor') }}</i>
                                  </h6>
                                  @if ($supervisors->count() > 0)
                                    <div id="supervisors-list" >
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ trans('student.nameSupervisor') }}</th>
                                                    <th>{{ trans('auth/student.department') }}</th>
                                                    <th>{{ trans('auth/student.specialty') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($supervisors as $supervisor)
                                                    <tr>
                                                        <td>
                                                          @php
                                                            $locale = app()->getLocale();
                                                            $name =
                                                            $locale === 'ar'
                                                              ? $supervisor->firstname_ar . ' ' . $supervisor->lastname_ar

                                                              : $supervisor->firstname_fr . ' ' . $supervisor->lastname_fr;
                                                          @endphp
                                                          {{ $name }}
                                                        </td>
                                                        <td>{{ $supervisor->departement }}</td>
                                                        <td>{{ $supervisor->speciality }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                                    </div>

                                  @else
                                      <small>{{ trans('student.no_supervisor') }}</small>
                                  @endif
                              </div>
                              @if (count($supervisors))
                              <button id="printSupervisors" data-url="{{ url('dashboard/print/supervisors/:student_id') }}" data-student-id="{{ $student->id }}"
                                class="btn btn-primary text-white">
                                <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                            </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>










    <div class="modal" id="uploadModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <form class="modal-content" id="contentForm" method="POST" action="{{ route('student.upload.photo') }}">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  @csrf
                  <input type="hidden" name="student_id" value="{{ $student->id }}">
                  <input type="file" class="form-control" name="image" id="newPhotoInput" accept="image/*">
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
  </div>


<style>
  .edit-icon {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background-color: #ffffff;
    border-radius: 100%;
    padding: 0 5px;
    cursor: pointer;
    font-size: 20px;
    color: #007bff;

  }
.avatar-container  {
  position: relative;
  display: inline-block;
}

.avatar-container img {
  border: 1px solid lightslategrey;
  padding: 5px;
}

</style>













    <script>

        $(document).ready(function() {
            $("#printSupervisors").click(function(e) {
                // منع الحدث الافتراضي للنقر
                e.preventDefault();

                // الحصول على معرّف الطالب
                let studentId = $(this).data('student-id');

                // الحصول على الـ URL وتعويض معرّف الطالب
                let url = $(this).attr('data-url').replace(':student_id', studentId);

                // فتح نافذة جديدة للطباعة
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');

                // انتظار تحميل النافذة قبل الطباعة
                printWindow.onload = function() {
                    printWindow.print();
                };
            });





  $('#contentForm').submit(function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        dataType: "json",
        contentType: false, // Don't set content type (let browser handle it)
        processData: false, // Don't process data (let browser handle it)
        success: function(response) {
            Swal.fire({
                icon: response.icon,
                title: response.state,
                text: response.message,
                confirmButtonText: "Ok"
              });
        },
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
