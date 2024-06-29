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
                                <div class="row">
                                    <div class="form-group col-md-6 px-1 mt-4">
                                        <a href="{{ route('dashboard.projects.edit_all_dates') }}" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('project.add_deadline') }}
                                        </a>
                                    </div>
                                </div>
                            </h5>
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{trans('project.label.name')}}</th>
                                            <th scope="col">{{ trans('project.status_project.status')}}</th>
                                            <th scope="col">{{trans('student.firstname')}} & {{trans('student.lastname')}}</th>
                                            <th scope="col">{{trans('student.groups')}}</th>
                                            <th scope="col">{{trans('supervisor.supervisors')}}</th>
                                            <th scope="col">{{trans('commission.commission')}}</th>
                                            <th scope="col">{{trans('app.actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <th scope="row"><a href="{{ url('dashboard/project/'.$project->id) }}">{{ $project->name }}</a></th>
                                                <td>
                                                    <ul class="status-list">
                                                        <li class="{{ $project->status == 0 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="radio" name="status_{{ $project->id }}" class="form-check-input" {{ $project->status == 0 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 0)">
                                                                <span class="btn btn-sm {{ $project->status == 0 ? 'btn-danger' : 'btn-custom-gray' }}">{{ trans('project.status_project.rejected') }}</span>
                                                            </label>
                                                        </li>
                                                        <li class="{{ $project->status == 1 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="radio" name="status_{{ $project->id }}" class="form-check-input" {{ $project->status == 1 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 1)">
                                                                <span class="btn btn-sm {{ $project->status == 1 ? 'btn-secondary' : 'btn-custom-gray' }}">{{ trans('project.status_project.under_studying') }}</span>
                                                            </label>
                                                        </li>
                                                        <li class="{{ $project->status == 2 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="radio" name="status_{{ $project->id }}" class="form-check-input" {{ $project->status == 2 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 2)">
                                                                <span class="btn btn-sm {{ $project->status == 2 ? 'btn-success' : 'btn-custom-gray' }}">{{ trans('project.status_project.accepted') }}</span>
                                                            </label>
                                                        </li>
                                                        <li class="{{ $project->status == 3 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="radio" name="status_{{ $project->id }}" class="form-check-input" {{ $project->status == 3 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 3)">
                                                                <span class="btn btn-sm {{ $project->status == 3 ? 'btn-warning' : 'btn-custom-gray' }}">{{ trans('project.status_project.complete_project') }}</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </td>
                                                
                                                <td>{{ $project->student->name }}</td>
                                                <td>
                                                    @php
                                                        $allStudents = \App\Models\StudentGroup::where('id_student', $project->student->id)->get();
                                                    @endphp
                                                    @if ($allStudents->count() > 0)
                                                        <ul>
                                                            @foreach($allStudents as $std)
                                                                @php
                                                                    $locale = app()->getLocale();
                                                                    $name = $locale === 'ar' ? $std->firstname_ar . ' ' . $std->lastname_ar : $std->firstname_fr . ' ' . $std->lastname_fr;
                                                                @endphp
                                                                <li>{{ $name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span>{{ trans('project.no_members') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($project->supervisingTeachers->isEmpty())
                                                        <p>{{ trans('supervisor.no_supervisors_available') }}</p>
                                                    @else
                                                        <ul>
                                                            @foreach($project->supervisingTeachers as $supervisor)
                                                                @php
                                                                    $locale = app()->getLocale();
                                                                    $name = $locale === 'ar' ? $supervisor->firstname_ar . ' ' . $supervisor->lastname_ar : $supervisor->firstname_fr . ' ' . $supervisor->lastname_fr;
                                                                @endphp
                                                                <li>{{ $name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($project->commission)
                                                        {{ $project->commission->name_ar }}
                                                    @else
                                                        <a href="{{ route('dashboard.projects.add_commission', $project->id) }}" class="btn btn-primary btn-sm">{{ trans('commission.add_commission') }}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @if ($project->type_project === null)
                                                                <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/add-type') }}">{{ trans('project.add_project_type') }}</a>
                                                            @else
                                                                <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/edit-type') }}">{{ trans('project.edit_project_type') }}</a>
                                                            @endif
                                                            @if($project->project_classification == null)
                                                                <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/add-classification')}}">{{ trans('project.add_project_classification') }}</a>
                                                            @else
                                                                <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/edit-classification')}}">{{ trans('project.edit_project_classification') }}</a>    
                                                            @endif
                                                            <a class="dropdown-item" href="{{ url('dashboard/project/'.$project->id.'/add-project-tracking') }}">{{ trans('project.project_tracking') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function updateStatus(projectId, status) {
            $.ajax({
                type: 'POST',
                url: '{{ route("dashboard.update_project_status") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    project_id: projectId,
                    status: status
                },
                success: function(response) {
                    console.log(response);
                    switch (response.status) {
                        case 0:
                            $('#project_status').css('background-color', 'red');
                            break;
                        case 1:
                            $('#project_status').css('background-color', 'yellow');
                            break;
                        case 2:
                            $('#project_status').css('background-color', 'green');
                            break;
                        case 3:
                            $('#project_status').css('background-color', 'blue');
                            break;
                        default:
                            break;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
{{-- @extends('layouts/contentNavbarLayout')
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
                                <div class="row">
                                    <div class="form-group col-md-6 px-1 mt-4">
                                        <a href="{{ route('dashboard.projects.edit_all_dates') }}" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('project.add_deadline') }}
                                        </a>
                                    </div>
                                    
                                </div>
                            </h5>
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{trans('project.label.name')}}</th>
                                            <th scope="col">{{ trans('project.status_project.status')}}</th>
                                            <th scope="col">{{trans('student.firstname')}} & {{trans('student.lastname')}}</th>
                                            <th scope="col">{{trans('student.groups')}}</th>
                                            <th scope="col">{{trans('supervisor.supervisors')}}</th>
                                            <th scope="col">{{trans('commission.commission')}}</th>
                                            <th scope="col">{{trans('app.actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <th scope="row"><a href="{{ url('dashboard/project/'.$project->id) }}">{{ $project->name }}</a></th>
                                                <td>
                                                    <ul class="status-list">
                                                        <li class="{{ $project->status == 0 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" {{ $project->status == 0 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 0)">
                                                                <span class="btn btn-sm {{ $project->status == 0 ? 'btn-danger' : 'btn-custom-gray' }}">{{ trans('project.status_project.rejected') }}</span>
                                                            </label>
                                                        </li>
                                                        <li class="{{ $project->status == 1 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" {{ $project->status == 1 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 1)">
                                                                <span class="btn btn-sm {{ $project->status == 1 ? 'btn-secondary' : 'btn-custom-gray' }}">{{ trans('project.status_project.under_studying') }}</span>
                                                            </label>
                                                        </li>
                                                        <li class="{{ $project->status == 2 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" {{ $project->status == 2 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 2)">
                                                                <span class="btn btn-sm {{ $project->status == 2 ? 'btn-success' : 'btn-custom-gray' }}">{{ trans('project.status_project.accepted') }}</span>
                                                            </label>
                                                        </li>
                                                        <li class="{{ $project->status == 3 ? 'selected' : '' }}">
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" {{ $project->status == 3 ? 'checked' : '' }} onclick="updateStatus({{ $project->id }}, 3)">
                                                                <span class="btn btn-sm {{ $project->status == 3 ? 'btn-warning' : 'btn-custom-gray' }}">{{ trans('project.status_project.complete_project') }}</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </td>                                          
                                                <td>{{ $project->student->name }}</td>
                                                <td>
                                                    @php
                                                    
                                                        $allStudents = \App\Models\StudentGroup::where('id_student', $project->student->id)->get();
                                                    @endphp
                                                    @if ($allStudents->count() > 0)
                                                        <ul>
                                                            @foreach($allStudents as $std)
                                                                @php
                                                                    $locale = app()->getLocale();
                                                                    $name =
                                                                    $locale === 'ar'
                                                                    ? $std->firstname_ar . ' ' . $std->lastname_ar
                                                                    : $std->firstname_fr . ' ' . $std->lastname_fr;
                                                                @endphp
                                                                <li> {{$name}}</li>
                                                            @endforeach    
                                                        </ul>    
                                                    @else
                                                        <span>{{ trans('project.no_members') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($project->supervisingTeachers->isEmpty())
                                                        <p>{{ trans('supervisor.no_supervisors_available') }}</p>
                                                    @else
                                                        <ul>
                                                            @foreach($project->supervisingTeachers as $supervisor)
                                                                @php
                                                                    $locale = app()->getLocale();
                                                                    $name =
                                                                    $locale === 'ar'
                                                                    ? $supervisor->firstname_ar . ' ' . $supervisor->lastname_ar
                                                                    : $supervisor->firstname_fr . ' ' . $supervisor->lastname_fr;
                                                                @endphp
                                                                <li>{{ $name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    @if ($project->commission)
                                                        {{ $project->commission->name_ar }}
                                                    @else
                                                        <a href="{{ route('dashboard.projects.add_commission', $project->id) }}" class="btn btn-primary btn-sm">{{ trans('commission.add_commission') }}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        function updateStatus(projectId, status) {
            $.ajax({
                type: 'POST',
                url: '{{ route("dashboard.update_project_status") }}',  
                data: {
                    _token: '{{ csrf_token() }}',
                    project_id: projectId,
                    status: status
                },
                success: function(response) {
                    console.log(response);
                    switch (response.status) {
                        case 0:
                            $('#project_status').css('background-color', 'red');
                            break;
                        case 1:
                            $('#project_status').css('background-color', 'yellow');
                            break;
                        case 2:
                            $('#project_status').css('background-color', 'green');
                            break;
                        case 3:
                            $('#project_status').css('background-color', 'blue');
                            break;
                        default:
                            break;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        function openDeadlineModal(projectId) {
            var url = '{{ url("dashboard/project") }}/' + projectId + '/add_deadline';
            var modalWindow = window.open(url, '_blank', 'width=800,height=600');
        }
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $("#downloadCertificate").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });

            $("#downloadReview").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection --}}
