@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title-dashboard'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <style>
        .btn-custom-gray {
            background-color: #d3d3d3;
        }

        .status-list li {
            padding-bottom: 10px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">{{ trans('commission.dashboard') }} /</span> {{ trans('project.projects') }}
                        </h4>
                    </div>
                </h5>
                <hr class="my-0">
                <div class="card-body pt-0">
                    <div class="card-body">
                        <div class="card">
                            <h5 class="card-header pt-0 mt-1">
                            </h5>
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{trans('project.label.name')}}</th>
                                            <th scope="col">{{trans('project.project_tracking')}}</th>
                                            <th scope="col">{{trans('project.status_project_tracking')}}</th>
                                            <th scope="col">{{trans('app.actions')}}</th>
                                            <th scope="col">{{ trans('app.print') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <th scope="row"><a href="{{ url('dashboard/project/'.$project->id) }}">{{ $project->name }}</a></th>
                                                <td>
                                                    @if($project->project_classification == 1 || $project->project_classification == 2)
                                                        @if($project->project_tracking == 1)
                                                            {{trans('auth/project.project_tracking.configuration_stage')}}
                                                        @elseif($project->project_tracking == 2)
                                                            {{trans('auth/project.project_tracking.create_bmc')}}    
                                                        @elseif($project->project_tracking == 3)
                                                            {{trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype')}}    
                                                        @elseif($project->project_tracking == 4)
                                                            {{trans('auth/project.project_tracking.discussion_stage')}}
                                                        @else
                                                            {{trans('auth/project.project_tracking.labelle_innovative_project')}}
                                                        @endif
                                                    @else
                                                        @if($project->project_tracking == 1)
                                                            {{trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype')}}
                                                        @elseif($project->project_tracking == 2)
                                                            {{trans('auth/project.project_tracking.write_a_descriptive_model')}}    
                                                        @elseif($project->project_tracking == 3)
                                                            {{trans('auth/project.project_tracking.stage_of_registering_a_patent_application')}}    
                                                        @elseif($project->project_tracking == 4)
                                                            {{trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application')}}
                                                        @elseif($project->project_tracking == 5)
                                                            {{trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI')}}
                                                        @elseif($project->project_tracking == 6)
                                                            {{trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations')}}
                                                        @else
                                                            {{trans('auth/project.project_tracking.obtained_a_patent')}}    
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($project->project_classification == 1 || $project->project_classification == 2)
                                                        @if($project->project_tracking == 1)
                                                            @if($project->status_project_tracking == 1)
                                                                <span class="text-warning">{{trans('auth/project.status_project_tracking.practice')}} </span>
                                                            @elseif($project->status_project_tracking == 2)
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.complete')}} </span>
                                                            @else
                                                                <span class="text-danger">{{trans('auth/project.status_project_tracking.not_yet')}} </span>
                                                            @endif
                                                        @elseif($project->project_tracking == 2 || $project->project_tracking == 3)
                                                            @if($project->status_project_tracking == 1)
                                                                <span class="text-warning">{{trans('auth/project.status_project_tracking.development_mode')}} </span>
                                                            @elseif($project->status_project_tracking == 2)
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.accomplished')}} </span>
                                                            @else
                                                                <span class="text-danger">{{trans('auth/project.status_project_tracking.not_completed')}} </span>
                                                            @endif
                                                            
                                                        @elseif($project->project_tracking == 4)
                                                            @if($project->status_project_tracking == 2)
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.discuss')}} </span>
                                                            @else
                                                                <span class="text-danger">{{trans('auth/project.status_project_tracking.not_discussed')}} </span>
                                                            @endif
                                                        @else
                                                            @if($project->status_project_tracking == 1)
                                                                <span class="text-warning">{{trans('auth/project.status_project_tracking.did_not_happen')}} </span>
                                                            @elseif($project->status_project_tracking == 2)
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.get')}} </span>
                                                            @else
                                                                <span class="text-light bg-dark">{{trans('auth/project.status_project_tracking.exclusion_or_waiver_of_the_student')}} </span>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if($project->project_tracking == 1)
                                                            @if($project->status_project_tracking == 1)
                                                                <span class="text-warning">{{trans('auth/project.status_project_tracking.development_mode')}} </span>
                                                            @elseif($project->status_project_tracking == 2)
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.accomplished')}} </span>
                                                            @else
                                                                <span class="text-danger">{{trans('auth/project.status_project_tracking.not_completed')}} </span>
                                                            @endif
                                                        @elseif($project->project_tracking == 2 )
                                                            @if($project->status_project_tracking == 1)
                                                                <span class="text-danger">{{trans('auth/project.status_project_tracking.no')}} </span>
                                                            @else
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.yes')}} </span>
                                                            @endif
                                                        @elseif($project->project_tracking == 3 || $project->project_tracking == 5 || $project->project_tracking == 6)
                                                            @if($project->status_project_tracking == 0)
                                                                <span >{{trans('auth/project.status_project_tracking.emty')}} </span>
                                                            @endif
                                                        @elseif($project->project_tracking == 4)
                                                            @if($project->status_project_tracking == 1)
                                                                <span class="text-danger">{{trans('auth/project.status_project_tracking.did_not_happen')}} </span>
                                                            @else
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.get')}} </span>
                                                            @endif
                                                        @else
                                                            @if($project->status_project_tracking == 1)
                                                            <span class="text-danger">{{trans('auth/project.status_project_tracking.no')}} </span>
                                                            @else
                                                                <span class="text-success">{{trans('auth/project.status_project_tracking.yes')}} </span>  
                                                            @endif
                                                        @endif
                                                    @endif        
                                                    
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @if($project->project_tracking == 0)
                                                                <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/add-project-tracking') }}">{{ trans('project.project_tracking') }}</a>
                                                            @else
                                                                <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/edit-project-tracking') }}">{{ trans('project.edit_project_tracking') }}</a>
                                                            @endif
                                                            <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/edit-status-project-tracking') }}">{{ trans('project.edit_status_project_tracking') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($project->project_classification == 1 || $project->project_classification == 2)
                                                        @if($project->status_project_tracking == 1)
                                                            <button id="printSupervisors" data-url="{{ url('dashboard/print/certificate/'.$project->id.'/label') }}" data-student-id="{{ $project->id }}"
                                                                class="btn btn-primary text-white">
                                                                <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        });
       
    </script>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{trans('project.add_project_tracking')}}: {{ $project->name }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('dashboard/project/'.$project->id.'/add-project-tracking') }}">
                        @csrf

                        <div class="form-group">
                            <label for="project_tracking" class="form-label">{{ trans('auth/project.project_trackingg') }}</label>
                            <select name="project_tracking" id="project_tracking" class="form-control @error('project_tracking') is-invalid @enderror">
                                <option value="">{{ trans('auth/project.project_tracking.select_a_stage') }}</option>
                                <option value="1">{{ trans('auth/project.project_tracking.configuration_stage') }}</option>
                                <option value="2">{{ trans('auth/project.project_tracking.create_bmc') }}</option>
                                <option value="3">{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}</option>
                                <option value="4">{{ trans('auth/project.project_tracking.discussion_stage') }}</option>
                                <option value="5">{{ trans('auth/project.project_tracking.labelle_innovative_project') }}</option>
                            </select>
                            @error('project_tracking')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
