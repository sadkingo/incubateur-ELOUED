<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ trans('print.title_print.project_report') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .card-header {
            text-align: left;
        }   
        .card-header[dir="rtl"] {
            text-align: right;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
        table {
            margin-top: 25px;
            width: 100%;
            border-collapse: collapse;
        }
        .table-print {
            width: 100%;
            text-align: center;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 2px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        @page {
            margin-top: 0;
            margin-bottom: 0;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="header-print-page" style="margin-top: 15px">
        <div class="row">
            <div class="col-3 text-right" >
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/logo.jpg') }}" alt="">
            </div>
            <div class="col-6">
                <h3 class="text-center title">{{ trans('print.university') }}</h3>
                <h5 class="text-center">{{ trans('print.incubater') }} </h5>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" >
            @php
                $name = app()->getLocale() === 'ar' ? $project->commission->name_ar  : $project->commission->name_fr;
            @endphp
            {{ $project->commission->id }} -  {{ $name }}
        </div>
        <div class="card-body">
            <table class="table table-print" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                <thead>
                    <tr>
                        {{-- <th>{{ trans('student.firstname') }}</th> --}}
                        <th>{{ trans('project.label.name') }}</th>
                        <th>{{ trans('project.label.type_project') }}</th>
                        <th>{{ trans('project.project_classification') }}</th>
                        <th>{{ trans('project.team_members') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>
                            @if($project->type_project == 1)
                                {{ trans('auth/project.project_commercial') }}
                            @elseif($project->type_project == 2)
                                {{ trans('auth/project.project_industrial') }}
                            @elseif($project->type_project == 3)
                                {{ trans('auth/project.project_agricultural') }}
                            @else
                                {{ trans('auth/project.project_service') }}
                            @endif
                        </td>
                        <td>
                            @if($project->project_classification == 1)
                                {{ trans('auth/project.small_scale_enterprise') }}
                            @elseif($project->project_classification == 2)
                                {{ trans('auth/project.start_up') }}
                            @else
                                {{ trans('auth/project.patent') }}
                            @endif
                        </td>
                        <td>
                            @if ($group->count() > 0)
                                <ul>
                                    @foreach($group as $student)
                                        <li>{{ app()->getLocale() === 'ar' ? $student->student->full_name_ar : $student->full_name_fr }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span>{{ trans('project.no_members') }}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            <strong>
                {{ trans('print.date_meeting') }}
                
            </strong><br>
            <strong>
                {{ trans('print.time_meeting') }} 
            </strong>
        </div>
    </div>
</body>
</html>
