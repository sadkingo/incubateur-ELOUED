<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
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

        th,
        td {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="header-print-page" style="margin-top: 15px">
        <div class="row">
            <div class="col-3 text-right">
                <img style="height: 100px; width:200px" src="{{ asset('assets/logo/logo.jpg') }}" alt="">
            </div>
            <div class="col-6">
                <h3 class="text-center title">{{ trans('print.title.project_report') }}</h3>
                <h5 class="text-center">{{ trans('print.date_print') }} : {{ date('Y-m-d H:i') }}</h5>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ trans('print.project_raport') }}
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class='text-center'>{{trans('print.project.type')}}</th>
                        <th scope="col" class='text-center'>{{trans('print.project.nombre')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{trans('print.project.accept')}} </td>
                        <td>{{ $acceptedProjectsCount }}</td>
                    </tr>
                    <tr>
                        <td>{{trans('print.project.reject')}} </td>
                        <td>{{ $rejectedProjectsCount }}</td>
                    </tr>
                    <tr>
                        <td>{{trans('print.project.understudy')}} </td>
                        <td>{{ $underStudyingProjectsCount }}</td>
                    </tr>
                    <tr>
                        <td>{{trans('print.project.complte')}} </td>
                        <td>{{ $completeProjectsCount }}</td>
                    </tr>
                    {{-- <tr>
                        <td>نسبة تقدم الطالب</td>
                        <td>{{ number_format($progressPercentage, 2) }}%</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
        
        {{-- <div class="form-group col-md-2 mr-5 mt-4">
            @if (count($projects))
                <button id="printStudentReport" data-url="{{ route('dashboard.print.studentReport') }}"
                    class="btn btn-primary text-white">
                    <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                </button>
            @endif
        </div>
    </div> --}}

 

</body>

</html>
