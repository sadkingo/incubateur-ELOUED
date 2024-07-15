<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ trans('print.title_print.statistic') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }

        .header-print-page {
            margin-top: 15px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            padding: 15px;
        }

        .logo {
            text-align: right;
        }

        .logo-img {
            height: 100px;
            width: 200px;
        }

        .title-section {
            text-align: center;
        }

        .title {
            margin-bottom: 0;
        }

        .date {
            margin-top: 0;
        }

        .content-section .row {
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .table-container {
            width: 100%;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header-print-page">
        <div class="row">
            <div class="col logo">
                <img class="logo-img" src="{{ asset('assets/logo/logo.jpg') }}" alt="">
            </div>
            <div class="col title-section">
                <h3 class="title">طباعة احصاء اعضاء الموقع</h3>
                <h5 class="date">{{ trans('print.date_print') }} : {{ date('Y-m-d H:i') }}</h5>
            </div>
        </div>
    </div>

    <div class="content-section">
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('dashboard.Project Statistics') }}</h5>
                <small>{{ $projects }}</small>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>حالة المشروع</th>
                                <th>عدد المشاريع</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ trans('dashboard.Number of accepted projects') }}</td>
                                
                                <td>{{ $acceptedProject }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('dashboard.Number of rejected projects') }}</td>
                                
                                <td>{{ $RejectedProjects }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('dashboard.Number of completed projects') }}</td>
                                
                                <td>{{ $compledProject }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('dashboard.Number of under study projects') }}</td>
                                
                                <td>{{ $projectsUnderStudy }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('dashboard.Number of new projects') }}</td>
                                
                                <td>{{ $newProjects }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('dashboard.Number of projects in selected year') }}</td>
                                
                                <td>{{ $projectsBySelectedYear }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>