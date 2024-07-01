@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title-certificates'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">
                    <div class="d-flex justify-content-between">
                        {{ trans('app.student') }}
                    </div>
                </h5>
                <hr class="my-0">
                <div class="card-body pt-0">
                    <div class="card">
                        <h5 class="card-header pt-0 mt-1">
                            <div class="row"></div>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table mb-2">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th>{{ trans('auth/project.project_trackingg') }}</th>
                                        <th>{{ trans('project.status_project_tracking') }}</th>
                                        <th>{{ trans('app.print') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
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
                                    @endphp

                                    <tr>
                                        <td>{{ $trackingLabels[$project->project_tracking] ?? trans('auth/project.project_tracking.labelle_innovative_project') }}</td>
                                        <td>
                                            <span class="{{ $getStatusClass($project->status_project_tracking) }}">
                                                {{ $getStatusLabel($project->status_project_tracking) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(
                                                ($project->project_classification == 1 || $project->project_classification == 2) &&
                                                ($project->project_tracking <= 3) &&
                                                $project->status_project_tracking == 2
                                            )
                                                <button id="printCertificate" data-url="{{ url('print/certificate/'.$project->id) }}" data-student-id="{{ $project->id }}" class="btn btn-primary text-white">
                                                    <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                                                </button>
                                            @elseif(
                                                ($project->project_classification != 1 && $project->project_classification != 2) &&
                                                ($project->project_tracking <= 3) &&
                                                $project->status_project_tracking == 2
                                            )
                                                <button id="printCertificate" data-url="{{ url('print/certificate/'.$project->id) }}" data-student-id="{{ $project->id }}" class="btn btn-primary text-white">
                                                    <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                                                </button>
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

            $(document).on('click', '#downloadCertificate, #downloadReview', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                window.open(url, '_blank', 'height=auto,width=auto').print();
            });
        });
    </script>
@endsection
