@php
    $isMenu = false;
    $navbarHideToggle = false;
    $currentDate = \Carbon\Carbon::now()->toDateString(); 
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
                    </div>
                </h5>
                <hr class="my-0">
                <div class="card-body pt-0">
                    <div class="card-body">
                        <div class="card">
                            <h5 class="card-header pt-0 mt-1">
                                <div class="row">
                                    <div class="form-group col-md-2 px-1 mt-4">
                                        <a href="{{ route('student.account.create') }}" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.Add_students') }}
                                        </a>
                                    </div>
                                    <div class="form-group col-md-2 px-1 mt-4">
                                        <a href="{{ route('student.project.create') }}" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.Add_project') }}
                                        </a>
                                    </div>
                                </div>
                            </h5>
                            
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{trans('project.label.name')}}</th>
                                            <th scope="col">{{ trans('project.status_project.status')}}</th>
                                            <th scope="col">{{ trans('project.status_project.status')}}</th>
                                            <th scope="col">{{ trans('app.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            @php
                                                $startDate = \Carbon\Carbon::parse($project->start_date)->toDateString();
                                                $endDate = \Carbon\Carbon::parse($project->end_date)->toDateString();
                                            @endphp
                                            <tr>
                                                <th scope="row">{{$project->name}} </th>
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
                                                <td>
                                                    @if($project->project_classification != null)
                                                        @if($project->project_classification == 1 || $project->project_classification == 2)
                                                            @if($project->bmc_status == 0)    
                                                            <a href="{{ url('student/project/'. $project->id .'/addBmc') }} " class="btn btn-primary text-white">{{ trans('project.status_project.enter_bmc_file') }}</a>
                                                            @elseif($project->bmc_status == 2)    
                                                                <span class="text-success">{{ trans('project.status_project.bmc_accepted') }}</span>
                                                            @elseif($project->bmc_status == 1) 
                                                                <a href="{{ url('student/project/'. $project->id .'/reformatBmc') }}" class="btn btn-primary text-danger">
                                                                    {{ trans('project.status_project.bmc_reformat') }}
                                                                </a>
                                                            @else
                                                                <span class="text-warning">{{trans('project.status_project.studying_bmc')}} </span>    
                                                            @endif    
                                                        @endif
                                                    @else
                                                        <span class="text-warning">{{ trans('project.classification.no_classifi') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    @if($currentDate < $startDate)
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <span class="text-info dropdown-item">{{ trans('project.edit_soon') }}</span>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteProjectModal{{ $project->id }}">
                                                                <i class="bx bx-trash me-2"></i>
                                                                {{ trans('project.delete') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                        
                                                    @elseif($currentDate >= $startDate && $currentDate <= $endDate)
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="{{ route('student.project.edit', $project->id) }}" class="dropdown-item">
                                                                    <i class="bx bx-edit-alt me-2"></i>
                                                                    {{ trans('project.edit_project') }}
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteProjectModal{{ $project->id }}">
                                                                    <i class="bx bx-trash me-2"></i>
                                                                    {{ trans('project.delete') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <span class="text-danger dropdown-item">{{ trans('project.edit_closed') }}</span>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteProjectModal{{ $project->id }}">
                                                                <i class="bx bx-trash me-2"></i>
                                                                {{ trans('project.delete') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                        
                                                    @endif
                                                </td>
                                            </tr>
                                            @include('student-project.delete')
                                        @endforeach
                                    </tbody>
                                </table>
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
@endsection
