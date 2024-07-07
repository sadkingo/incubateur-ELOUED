@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ trans('dashboard.welcome') }} 🎉</h5>
                            <p class="mb-4">
                                {{ trans('dashboard.Here, you can asily track annual revenue trends, monitor weekly and monthly order patterns, and gain insights into user behavior through comprehensive reports.') }}
                            </p>
                            {{-- <a href="{{ url('tldr') }}" class="btn btn-sm btn-outline-primary">View Badges</a> --}}
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='bx bx-user-check' style='color:#93e878; font-size:48px'></i>
                                </div>
                                <div class="dropdown">

                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">{{ trans('dashboard.admins') }}</span>
                            <h3 class="card-title mb-2">{{ count($admins) }}</h3>
                            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +1%</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='text-info bx bx-user-check' style=' font-size:48px'></i>
                                </div>
                                <div class="dropdown">
                                </div>
                            </div>
                            <span>{{ trans('dashboard.teachers') }}</span>
                            <h3 class="card-title text-nowrap mb-1">{{ count($teachers) }}</h3>
                            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +0%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Revenue -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">{{ trans('dashboard.General statistics.') }}</h5>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary " type="button">
                                        <select class="form-select form-select-sm" name="year" id="year">
                                            @foreach ($uniqueYears as $uniqueYear)
                                                <option value="{{ $uniqueYear }}">{{ $uniqueYear }}</option>
                                            @endforeach
                                        </select>
                                    </button>

                                </div>
                            </div>
                        </div>
                        {{-- <div id="totalRevenueChart" class="px-2"></div> --}}
                        <div class="px-2 w-100 h-100">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary " type="button">
                                        <select class="form-select form-select-sm" name="year" id="yearGender">
                                            @foreach ($uniqueYears as $uniqueYear)
                                                <option value="{{ $uniqueYear }}">{{ $uniqueYear }}</option>
                                            @endforeach
                                        </select>
                                    </button>

                                </div>
                            </div>
                        </div>
                        {{-- <div id="growthChart"></div> --}}
                        <div class="px-2 w-100 h-100">
                            <canvas id="myChartGender"></canvas>
                        </div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-primary p-2"><i
                                            class="bx bx-dollar text-primary"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>2022</small>
                                    <h6 class="mb-0">$32.5k</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>2021</small>
                                    <h6 class="mb-0">$41.2k</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='text-danger bx bx-user-check' style=' font-size:48px'></i>
                                </div>

                            </div>
                            <span class="d-block mb-1">{{ trans('dashboard.students') }}</span>
                            <h3 class="card-title text-nowrap mb-2">{{ count($students) }}</h3>
                            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +3%</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='text-primary bx bx-user-check' style=' font-size:48px'></i>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">{{ trans('dashboard.student_groups') }}</span>
                            <h3 class="card-title mb-2">{{ $studentGroups }}</h3>
                            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +2.14%</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='text-primary bx bx-user-check' style=' font-size:48px'></i>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">{{ trans('dashboard.all_students') }}</span>
                            <h3 class="card-title mb-2">{{ $allStudents }}</h3>
                            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +2.14%</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='bx bxs-buildings' style="font-size:48px"></i>
                                    {{-- {{-- <i class='text-primary bx bx-user-check' style=' font-size:48px'  ></i>  --}}
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">{{ trans('dashboard.projects') }}</span>
                            <h3 class="card-title mb-2">{{ $projects }}</h3>
                            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +2.14%</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">
                                            {{ trans('dashboard.Number of students whose projects were accepted') }}</h5>
                                        <span
                                            class="badge bg-label-warning rounded-pill">{{ trans('dashboard.accepted') }}</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <small class="text-success text-nowrap fw-semibold"><i
                                                class='bx bx-chevron-up'></i> 1%</small>
                                        <h3 class="mb-0">{{ $acceptedProject }}</h3>
                                    </div>
                                </div>
                                {{-- <div ><i class='bx bx-trophy'></i></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Project Statistics -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.Project Statistics') }}</h5>
                        <small class="text-muted">{{ $projects }}</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $projects }}</h2>
                            <span>{{ trans('dashboard.Number of registered projects') }}</span>
                        </div>
                        <div class="px-2 w-100 h-100">
                            <canvas id="myProjectChart"></canvas>
                        </div>
                    </div>
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class='bx bx-check-circle'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Number of accepted projects') }}</h6>
                                    <small class="text-muted">{{ trans('dashboard.All projects') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small id="AcceptedProjects" class="fw-semibold">{{ $acceptedProject }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger"><i class='bx bx-x-circle'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Number of rejected projects') }}</h6>
                                    <small class="text-muted">{{ trans('dashboard.All projects') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small id="RejectedProjects" class="fw-semibold">{{ $RejectedProjects }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class='bx bx-edit-alt'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Number of completed projects') }}</h6>
                                    <small class="text-muted">{{ trans('dashboard.All projects') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small id="CompletedProjects" class="fw-semibold">{{ $compledProject }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i
                                        class='bx bx-folder-open'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Number of under study projects') }}</h6>
                                    <small class="text-muted">{{ trans('dashboard.All projects') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small id="ProjectsUnderStudy" class="fw-semibold">{{ $projectsUnderStudy }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class='bx bx-folder-plus'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Number of new projects') }}</h6>
                                    <small class="text-muted">{{ trans('dashboard.All projects') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small id="NewProjects" class="fw-semibold">{{ $newProjects }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class='bx bx-calendar'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Number of projects in selected year') }}</h6>
                                    <small class="text-muted">{{ trans('dashboard.All projects') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small id="ProjectsByYear" class="fw-semibold">{{ $projectsBySelectedYear }}</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Project Statistics -->
        
        <!-- Project Classification Stats -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.Project Classification') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <canvas id="projectClassificationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Project Classification Stats -->
        
        <!-- Startup and Patent Label Students Stats -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-3 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.Student Label Statistics') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i class='bx bx-rocket'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Startup Label Students') }}</h6>
                                    <small
                                        class="text-muted">{{ trans('dashboard.Students with Startup Project Label') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small class="fw-semibold">{{ $startupLabelStudentsCount }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class='bx bx-badge-check'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ trans('dashboard.Patent Label Students') }}</h6>
                                    <small
                                        class="text-muted">{{ trans('dashboard.Students with Patent Project Label') }}</small>
                                </div>
                                <div class="project-progress">
                                    <small class="fw-semibold">{{ $patentLabelStudentsCount }}</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Startup and Patent Label Students Stats -->
        
        <!-- Chart for Projects by Year -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.Projects by Year') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <canvas id="projectsByYearChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Chart for Projects by Year -->

        <!-- Statistics of projects awarded to a mini project by faculty -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.mini project by faculty') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column p-2">
                        @if(count($miniProjectStatsByFaculty) > 0)
                            <ul class="list-group">
                                @foreach($miniProjectStatsByFaculty as $facultyName => $count)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <i class="bx bx-building"></i> {{ $facultyName }}
                                        <span class="badge bg-primary rounded-pill">{{ $count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-danger"><i class="bx bx-error-circle"></i> {{ trans('dashboard.mini project empty') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics of projects awarded to a mini project by faculty -->

        <!-- Statistics of projects awarded to a startup project by faculty -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.startup project by faculty') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column p-2">
                        @if(count($startupProjectStatsByFaculty) > 0)
                            <ul class="list-group">
                                @foreach($startupProjectStatsByFaculty as $facultyName => $count)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <i class="bx bx-building-house"></i> {{ $facultyName }}
                                        <span class="badge bg-success rounded-pill">{{ $count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-danger"><i class="bx bx-error-circle"></i> {{ trans('dashboard.startup project empty') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics of projects awarded to a startup project by faculty -->

        <!-- Statistics of projects awarded to a patent project by faculty -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.patent by faculty') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column p-2">
                        @if(count($patentProjectStatsByFaculty) > 0)
                            <ul class="list-group">
                                @foreach($patentProjectStatsByFaculty as $facultyName => $count)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <i class="bx bx-medal"></i> {{ $facultyName }}
                                        <span class="badge bg-warning rounded-pill">{{ $count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-danger"><i class="bx bx-error-circle"></i> {{ trans('dashboard.patent project empty') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics of projects awarded to a patent project by faculty -->
        <!-- Mini Project Stages Statistics -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.Mini Project Stages Statistics') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-2 m-0">
                        @foreach ($miniProjectStages as $stage => $data)
                        <li class="d-flex mb-4 pb-1">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">
                                        <i class="fas fa-project-diagram"></i> 
                                        {{ trans("dashboard.$stage") }}
                                    </h6>
                                    @foreach ($data as $status => $count)
                                    <small class="text-muted">
                                        <i class="fas fa-tasks"></i> 
                                        {{ trans("dashboard.$status") }}: {{ $count }}
                                    </small><br>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Mini Project Stages Statistics -->
        <!-- Startup Project Stages Statistics -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.Startup Project Stages Statistics') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-2 m-0">
                        @foreach ($startupProjectStages as $stage => $data)
                            <li class="d-flex mb-4 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">
                                            <i class="fas fa-rocket"></i> 
                                            {{ trans("dashboard.$stage") }}
                                        </h6>
                                        @foreach ($data as $status => $count)
                                        <small class="text-muted">
                                            <i class="fas fa-tasks"></i> 
                                            {{ trans("dashboard.$status") }}: {{ $count }}
                                        </small><br>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Startup Project Stages Statistics -->

        <!-- Patent Stages Statistics -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ trans('dashboard.Patent Stages Statistics') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-2 m-0">
                        @foreach ($patentStages as $stage => $data)
                        <li class="d-flex mb-4 pb-1">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">
                                        <i class="fas fa-lightbulb"></i> 
                                        {{ trans("dashboard.$stage") }}
                                    </h6>
                                    @foreach ($data as $status => $count)
                                    <small class="text-muted">
                                        <i class="fas fa-tasks"></i> 
                                        {{ trans("dashboard.$status") }}: {{ $count }}
                                    </small><br>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Patent Stages Statistics -->
    </div>   
@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // ! ** Chart **
            $.ajax({
                url: "{{ url('dashboard/analyse/added') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    console.log(response.student);
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['ديسمبر', 'نوفمبر', 'أكتوبر', 'سبتمبر', 'أوت', 'جويلية',
                                'جوان', 'ماي', 'أفريل', 'مارس', 'فيفري', 'جانفي'
                            ],
                            datasets: [{
                                label: 'إحصائيات طلبة جدد حسب شهر',
                                data: [response.studentDec, response.studentNov,
                                    response.studentOct, response.studentSep,
                                    response.studentAot, response.studentJui,
                                    response.studentJun, response.studentMai,
                                    response.studentApr, response.studentMar,
                                    response.studentFev, response.studentJan
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
            // **
            $.ajax({
                url: "{{ url('dashboard/analyse/gender') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    console.log(response.student);
                    const ctx = document.getElementById('myChartGender');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['إناث', 'ذكور'],
                            datasets: [{
                                label: 'عدد ذكور و إناث في لعام',
                                data: [response.women, response.men],
                                backgroundColor: ['rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)'
                                ],
                                hoverOffset: 5
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });

            $.ajax({
                url: "{{ url('dashboard/analyse/point') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    document.getElementById('studentMax').innerHTML = response.max;
                    document.getElementById('studentMoyen').innerHTML = response.moyen;
                    document.getElementById('studentMin').innerHTML = response.min;
                    console.log(response.student);
                    const ctx = document.getElementById('myChartPoint');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['20-15', '10-15', 'أقل من 10'],
                            datasets: [{
                                label: 'الإحصائيات المعدلات',
                                data: [response.max, response.moyen, response.min],
                                backgroundColor: ['rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)', 'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 20
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });

            $('#year').on('change', function() {
                var year = $(this).val();
                console.log(year);
                $.ajax({
                    url: "{{ url('dashboard/analyse/added') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: {
                        year: year
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response.student);
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['ديسمبر', 'نوفمبر', 'أكتوبر', 'سبتمبر', 'أوت',
                                    'جويلية', 'جوان', 'ماي', 'أفريل', 'مارس',
                                    'فيفري', 'جانفي'
                                ],
                                datasets: [{
                                    label: 'إحصائيات طلبة جدد حسب شهر',
                                    data: [response.studentDec, response
                                        .studentNov, response.studentOct,
                                        response.studentSep, response
                                        .studentAot, response.studentJui,
                                        response.studentJun, response
                                        .studentMai, response.studentApr,
                                        response.studentMar, response
                                        .studentFev, response.studentJan
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });
            });
            $('#yearGender').on('change', function() {
                var year = $(this).val();
                console.log(year);
                $.ajax({
                    url: "{{ url('dashboard/analyse/gender') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: {
                        year: year
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response.student);
                        const ctx = document.getElementById('myChartGender');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['ديسمبر', 'نوفمبر', 'أكتوبر', 'سبتمبر', 'أوت',
                                    'جويلية', 'جوان', 'ماي', 'أفريل', 'مارس',
                                    'فيفري', 'جانفي'
                                ],
                                datasets: [{
                                    label: 'إحصائيات طلبة جدد حسب شهر',
                                    data: [response.studentDec, response
                                        .studentNov, response.studentOct,
                                        response.studentSep, response
                                        .studentAot, response.studentJui,
                                        response.studentJun, response
                                        .studentMai, response.studentApr,
                                        response.studentMar, response
                                        .studentFev, response.studentJan
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });
            });
        });
        var ctx = document.getElementById('myProjectChart').getContext('2d');
        var myProjectChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['{{ trans('dashboard.Rejected') }}', '{{ trans('dashboard.Under Study') }}',
                    '{{ trans('dashboard.New') }}', '{{ trans('dashboard.Accepted') }}',
                    '{{ trans('dashboard.Completed') }}'
                ],
                datasets: [{
                    label: '{{ trans('dashboard.Projects') }}',
                    data: [{{ $RejectedProjects }}, {{ $projectsUnderStudy }}, {{ $newProjects }},
                        {{ $acceptedProject }}, {{ $compledProject }}
                    ],
                    backgroundColor: ['#ff6384', '#36a2eb', '#00A36C', '#008000', '#2AAA8A	'],
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const projectsByYearData = @json($chartProjectsByYearData);
        const ctxProjectsByYear = document.getElementById('projectsByYearChart').getContext('2d');
        new Chart(ctxProjectsByYear, {
            type: 'bar',
            data: {
                labels: projectsByYearData.labels,
                datasets: [{
                    label: '{{ trans('dashboard.Projects by Year') }}',
                    data: projectsByYearData.datasets[0].data,
                    backgroundColor: projectsByYearData.datasets[0].backgroundColor,
                    borderColor: projectsByYearData.datasets[0].borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: '{{ trans('dashboard.Year') }}'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: '{{ trans('dashboard.Number of Projects') }}'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            new Chart(document.getElementById('projectClassificationChart').getContext('2d'), {
                type: 'bar',
                data: @json($chartProjectClassificationData),
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;

                                    return `${label}: ${value} ${trans('dashboard.Projects')}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                        }
                    }
                }
            });
        });
    
    </script>
@endsection
