@php
    $isMenu = false;
    $navbarHideToggle = false;
    if($project != null){
        $trackingLabels = [
            1 => $project->project_classification == 1 || $project->project_classification == 2
                ? trans('auth/project.project_tracking.configuration_stage')
                : trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype'),
            2 => $project->project_classification == 1 || $project->project_classification == 2
                ? trans('auth/project.project_tracking.create_bmc')
                : trans('auth/project.project_tracking.write_a_descriptive_model'),
            3 => $project->project_classification == 1 || $project->project_classification == 2
                ? trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype')
                : trans('auth/project.project_tracking.stage_of_registering_a_patent_application'),
            4 => $project->project_classification == 1 || $project->project_classification == 2
                ? trans('auth/project.project_tracking.discussion_stage')
                : trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application'),
            5 => trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI'),
            6 => trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations'),
        ];

        $statusLabels = [
            1 => trans('auth/project.status_project_tracking.practice'),
            2 => trans('auth/project.status_project_tracking.complete'),
            0 => trans('auth/project.status_project_tracking.not_yet'),
        ];

        $statusColors = [
            1 => 'text-warning',
            2 => 'text-success',
            0 => 'text-danger',
        ];

        $getStatusLabel = fn($status) => $statusLabels[$status] ?? '';
        $getStatusClass = fn($status) => $statusColors[$status] ?? 'text-light bg-dark';
    }   
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title-dashboard'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>



@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            {{ trans('app.student') }}
                        </div>
                        {{-- <div class="">
                            @if ($account->tests->count() > 0)
                                <button target="_blank" id="downloadReview"
                                    data-url="{{ route('download.review', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white">
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_review') }}
                                </button>
                                {{-- <button target="_blank" id="downloadCertificate"
                                    data-url="{{ route('download.certificate', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white"
                                >
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_certificate') }}
                                </button>  

                                <a target="_blank"
                                    href="{{ route('download.certificate', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white">
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_certificate') }}
                                </a>
                            @endif
                        </div> --}}
                    </div>
                </h5>
                <hr class="my-0">
                <div class="card-body pt-0">
                    <div class="card-body">
                        <div class="card">
                            <h5 class="card-header pt-0 mt-1">
                                {{-- <form action="" method="GET" id="filterStudentForm" class="">
                                    <div class="row">
                                        @if (auth('admin')->check())
                                            <div class="form-group col-md-2 px-1 mt-4">
                                                <a href="{{ route('dashboard.students.create') }}" class="btn btn-primary text-white">
                                                    <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.create') }}
                                                </a>
                                            </div>
                                        @endif
                    
                                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="search" class="form-label">{{ trans('app.label.name') }}</label>
                                            <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                                                class="form-control input-solid"
                                                placeholder="{{ Request::get('search') != '' ? '' : trans('app.placeholder.name') }}">
                                        </div>
                                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="registration_number"
                                                class="form-label">{{ trans('student.label.registration_number') }}</label>
                                            <input type="text" id="registration_number" name="registration_number"
                                                value="{{ Request::get('registration_number') }}" class="form-control input-solid"
                                                placeholder="{{ Request::get('registration_number') != '' ? '' : trans('student.placeholder.registration_number') }}">
                                        </div>
                    
                                        <div class="form-group col-md-2 mb-2 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="batch" class="form-label">{{ trans('student.label.batch') }}</label>
                                            <select class="form-select" id="batch" name="batch" aria-label="Default select example">
                                                @if (Request::get('batch') != null)
                                                    <option value="{{ Request::get('batch') }}">
                                                        {{ trans('app.batchs.' . Request::get('batch')) }}</option>
                                                @else
                                                    <option value="">{{ trans('app.select.batch') }}</option>
                                                @endif
                                                <option value="">{{ trans('app.all') }}</option>
                                                <option value="1">{{ trans('app.batchs.1') }}</option>
                                                <option value="2">{{ trans('app.batchs.2') }}</option>
                                                <option value="3">{{ trans('app.batchs.3') }}</option>
                                                <option value="4">{{ trans('app.batchs.4') }}</option>
                                                <option value="5">{{ trans('app.batchs.5') }}</option>
                                                <option value="6">{{ trans('app.batchs.6') }}</option>
                                                <option value="7">{{ trans('app.batchs.7') }}</option>
                                                <option value="8">{{ trans('app.batchs.8') }}</option>
                                                <option value="9">{{ trans('app.batchs.9') }}</option>
                                                <option value="10">{{ trans('app.batchs.10') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="group" class="form-label">{{ trans('student.label.group') }}</label>
                                            <select class="form-select" id="group" name="group" aria-label="Default select example">
                                                @if (Request::get('group') != null)
                                                    <option value="{{ Request::get('group') }}">
                                                        {{ trans('app.groups.' . Request::get('group')) }}</option>
                                                @else
                                                    <option value="">{{ trans('attendence.select.group') }}</option>
                                                @endif
                                                <option value="">{{ trans('app.all') }}</option>
                    
                                                @for ($group = 1; $group <= $groups; $group++)
                                                    <option value="{{ $group }}">{{ trans('app.groups.' . $group) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                    
                                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="start_date" class="form-label">{{ trans('student.label.start_date') }}</label>
                                            <input type="date" class="form-control input-solid" placeholder="YYYY-MM-DD"
                                                style="background-color: #ffffff" name="start_date" id="start_date"
                                                value="{{ Request::get('start_date') }}" />
                                        </div>
                                        <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="end_date" class="form-label">{{ trans('student.label.end_date') }}</label>
                                            <input type="date" class="form-control input-solid" placeholder="YYYY-MM-DD"
                                                style="background-color: #ffffff" name="end_date" id="end_date"
                                                value="{{ Request::get('end_date') }}" />
                                        </div>
                                        <div class="form-group col-md-2 mb-2">
                                            <label for="year" class="form-label">{{ trans('app.label.year') }}</label>
                                            <select class="form-select" id="year" name="year" aria-label="Default select example">
                                                <option value="">{{ trans('app.select.year') }}</option>
                                                <option value="">{{ trans('app.option.year_all') }}</option>
                                                @for ($i = $start_date; $i <= \Carbon\Carbon::now()->format('Y'); $i++)
                                                    <option value="{{ $i }}" {{ Request::get('year') == $i ? 'selected' : '' }}>
                                                        {{ trans('app.year') . ' ' . $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                    
                                        <div class="form-group col-md-2 mb-2">
                                            <label for="rank" class="form-label">{{ trans('app.label.rank') }}</label>
                                            <select class="form-select" id="rank" name="rank" aria-label="Default select example">
                                                <option value="">{{ trans('app.select.rank') }}</option>
                                                <option value="all" {{ Request::get('rank') == 'all' ? 'selected' : '' }}>{{ trans('app.option.rank_all') }}</option>
                                                <option value="1" {{ Request::get('rank') == 1 ? 'selected' : '' }}>
                                                    {{ trans('app.ranks.1') }}</option>
                                                <option value="2"{{ Request::get('rank') == 2 ? 'selected' : '' }}>
                                                    {{ trans('app.ranks.2') }}</option>
                                                <option value="3"{{ Request::get('rank') == 3 ? 'selected' : '' }}>
                                                    {{ trans('app.ranks.3') }}</option>
                                            </select>
                                        </div>
                    
                                        <div class="form-group col-md-2 mb-2">
                                            <label for="passport" class="form-label">{{ trans('app.label.passport') }}</label>
                                            <select class="form-select" id="passport" name="passport" aria-label="Default select example">
                                                <option value="">{{ trans('app.select.passport') }}</option>
                                                <option value="0" {{ Request::get('passport') == 0 ? 'selected' : '' }}>
                                                    {{ trans('app.no_passport') }}</option>
                                                <option value="1"{{ Request::get('passport') == 1 ? 'selected' : '' }}>
                                                    {{ trans('app.have_passport') }}</option>
                    
                                            </select>
                                        </div>
                                        {{-- <div class="form-group col-md-3 mb-2">
                                            <label for="perPage" class="form-label">{{ trans('app.label.perPage') }}</label>
                                            <select class="form-select" id="perPage" name="perPage" aria-label="Default select example">
                                                <option value="">{{ trans('app.select.perPage') }}</option>
                                                <option value="{{ $students->count() *$students->perPage() }}">{{ trans('app.all') }}</option>
                                                <option value="10" {{ Request::get('perPage') == 10 ? 'selected' : '' }}>
                                                    10</option>
                                                <option value="50"{{ Request::get('perPage') == 50 ? 'selected' : '' }}>
                                                    50</option>
                                                    <option value="100"{{ Request::get('perPage') == 100 ? 'selected' : '' }}>
                                                        100</option>
                                            </select>
                                        </div> --}}
                                        {{-- perPage  
                                    </div>
                                </form> --}}
                                <div class="row">
                                    <div class="form-group col-md-4 px-1 mt-4">
                                        <a href="{{ route('student.account.create') }}" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.Add_students') }}
                                        </a>
                                    </div>
                                    <div class="form-group col-md-4 px-1 mt-4">
                                        <a href="{{ route('student.project.create') }}" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.Add_project') }}
                                        </a>
                                    </div>
                                    <div class="form-group col-md-4 px-1 mt-4">
                                        <a href="{{ route('student.supervisor.create') }}" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.Add_supervisor') }}
                                        </a>
                                    </div>
                                    
                                </div>
                            </h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table mb-2">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>{{ trans('student.name') }}</th>
                                            <th>{{ trans('student.birthday') }}</th>
                                            <th>{{ trans('student.gender') }}</th>
                                            <th>{{ trans('app.actions') }}</th>
                                            <th>{{ trans('app.print')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($studentGroups as $key => $studentGroup)
                                            <tr>
                                                <td>{{ $studentGroup->firstname_ar }} {{$studentGroup->lastname_ar}}</td>
                                                <td>{{ $studentGroup->birthday }}</td>
                                                <td>{{ $studentGroup->gender == 1 ? trans('student.male') : trans('student.female') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('student.account.edit', $studentGroup->id) }}">
                                                                <i class="bx bx-edit-alt me-2"></i>
                                                                {{ trans('student.edit') }}
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#deleteStudentModal{{ $studentGroup->id }}">
                                                                <i class="bx bx-trash me-2"></i>
                                                                {{ trans('student.delete') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($project != null)
                                                        @if(
                                                            ($project->project_classification == 1 || $project->project_classification == 2) &&
                                                            ($project->project_tracking <= 3) &&
                                                            $project->status_project_tracking == 2
                                                        )
                                                            <button id="printCertificate" data-url="{{ url('print/certificate/'.$project->id.'/'.$studentGroup->id) }}" data-student-id="{{ $project->id }}" class="btn btn-primary text-white">
                                                                <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                                                            </button>
                                                        @elseif(
                                                            ($project->project_classification != 1 && $project->project_classification != 2) &&
                                                            ($project->project_tracking <= 3) &&
                                                            $project->status_project_tracking == 2
                                                        )
                                                            <button id="printCertificate" data-url="{{ url('print/certificate/'.$project->id.'/'.$studentGroup->id) }}" data-student-id="{{ $project->id }}" class="btn btn-primary text-white">
                                                                <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                                                            </button>
                                                        @endif
                                                @endif
                                                </td>
                                            </tr>
                                            @include('student-dashboard.delete')
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center text-danger"><em>@lang('لا يوجد سجلات.')</em></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            {{-- <hr class="my-4" style="border-color: #8a2be2; border-width: 3px;">
                            
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{trans('project.label.name')}}</th>
                                            <th scope="col">{{ trans('project.status_project.status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <th scope="row">{{$project->name}}</th>
                                                <td>
                                                    @if($project->status == 1)
                                                        <span class="text-muted">{{ trans('project.status_project.under_studying') }}</span>
                                                    @elseif($project->status == 2)
                                                        <span class="text-success">{{ trans('project.status_project.accepted') }}</span>
                                                    @elseif($project->status == 3)
                                                        <span class="text-warning">{{ trans('project.status_project.complete_project') }}</span>
                                                    @else
                                                        <span class="text-danger">{{ trans('project.status_project.rejected') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            
            $(document).on('click', '#printCertificate', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                window.open(url, '_blank', 'height=auto,width=auto').onload = function() {
                    this.print();
                };
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
@endsection
