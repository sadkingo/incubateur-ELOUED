<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('suporvisor_raport.title') }}</title>
    <style>
        @page {
            size: 21cm 27cm;
            margin: 0;
        }

        @media print {
            body {
                margin: 0;
            }
            header, footer {
                display: none;
            }
            .container {
                page-break-before: auto;
                page-break-after: auto;
                page-break-inside: avoid;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }
        .header img {
            width: 80px;
            height: auto;
            position: absolute;
            top: 0;
        }
        .header .left-logo {
            left: 0;
        }
        .header .right-logo {
            right: 0;
        }
        .header .text {
            display: inline-block;
            text-align: center;
            width: 60%;
        }
        .header h1, .header h2, .header h3 {
            margin: 2px 0;
            font-size: 16px;
        }
        .sidebar {
            position: relative;
            text-align: right;
            font-size: 14px;
            margin-top: 10px;
            margin-right: 10px;
        }
        .sidebar p {
            margin: 5px 0;
        }
        .center-title {
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .signature {
            text-align: right;
            font-size: 14px;
            margin-top: 5px;
            margin-right: 10px;
        }
        .signature p {
            margin: 5px 0;
        }
        .students-table, .supervisors-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }
        .students-table th, .students-table td,
        .supervisors-table th, .supervisors-table td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: right;
        }
        .students-table th, .supervisors-table th {
            background-color: #f2f2f2;
        }
        .additional-section {
            text-align: right;
            margin: 10px 10px;
            font-size: 14px;
        }
        .container {
            border: 1px solid #000; 
            padding: 90px; 
            margin: 20px; 
            box-shadow: 5px 5px 2px #888888; 
        }
        .left-section {
            text-align: left;
            margin: 10px 10px;
            font-size: 14px;
        }
        .center-section {
            text-align: center;
            margin: 10px 0;
            font-size: 14px;
            padding: 10px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/logo/logo.jpg') }}" alt="Left Logo" class="left-logo">
            <div class="text">
                <h1>{{trans('suporvisor_raport.people_s_democratic_republic_of_algeria')}}</h1>
                <h2>{{trans('suporvisor_raport.ministry_of_higher_education_and_scientific_research')}}</h2>
                <h3>{{trans('suporvisor_raport.el_oued_university')}}</h3>
                <h3>{{trans('suporvisor_raport.university_business_incubator')}}</h3>
            </div>
            <img src="{{ asset('assets/logo/logo.jpg') }}" alt="Right Logo" class="right-logo">
        </div>

        <div class="sidebar">
            <p>{{trans('suporvisor_raport.NoIncubator')}}{{date('Y')}}</p>
        </div>

        <div class="center-title">
            <h2>{{trans('suporvisor_raport.localization_certificate')}}</h2>
        </div>

        <div class="signature">
            <p>{{trans('suporvisor_raport.signature.I_m_the_goer')}}</p>
            <p>{{trans('suporvisor_raport.signature.incubator_manager')}}</p>
            <p>{{trans('suporvisor_raport.signature.address')}}</p>
            <p>{{trans('suporvisor_raport.signature.Noincubator')}}</p>
            <p>{{trans('suporvisor_raport.signature.date_incubator')}}</p>
        </div>

        <div style="direction: rtl;">
            <h2>{{trans('suporvisor_raport.student.certify')}}</h2>
            <table class="students-table">
                <thead>
                    <tr>
                        <th>{{trans('suporvisor_raport.student.name')}}</th>
                        <th>{{trans('suporvisor_raport.student.birthday')}}</th>
                        <th>{{trans('suporvisor_raport.student.NoRegister')}}</th>
                        <th>{{trans('suporvisor_raport.student.academic_stage')}}</th>
                        <th>{{trans('suporvisor_raport.student.faculty')}}</th>
                        <th>{{trans('suporvisor_raport.student.speciality')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $student->firstname_ar }} {{$student->lastname_ar}}</td>
                        <td>{{ $student->birthday }} {{ $student->state_of_birth }} </td>
                        <td>{{ $student->registration_number }}</td>
                        <td>{{ $student->academicLevel }}</td>
                        <td>{{ $student->specialty }}</td>
                        <td>{{ $faculty->name_ar }}</td>
                    </tr>
                    @if($studentGroups != null)
                        @foreach($studentGroups as $groupe)
                            <tr>
                                <td>{{ $groupe->firstname_ar }} {{$groupe->lastname_ar}}</td>
                                <td>{{ $groupe->birthday }} {{ $groupe->state_of_birth }}</td>
                                <td>{{ $groupe->registration_number }}</td>
                                <td>{{ $groupe->academicLevel }}</td>
                                <td>{{ $groupe->specialty }}</td>
                                <td>{{ $groupe->faculty }}</td>
                            </tr>
                        @endforeach
                    @endif       
                </tbody>
            </table>
        </div>

        <div class="supervisors-section" style="direction: rtl;">
            <h2>{{trans('suporvisor_raport.supervisor.under_supervision')}}</h2>
            <table class="supervisors-table">
                <thead>
                    <tr>
                        <th>{{trans('suporvisor_raport.supervisor.name')}}</th>
                        <th>{{trans('suporvisor_raport.supervisor.grad')}}</th>
                        <th>{{trans('suporvisor_raport.supervisor.faculty')}}</th>
                        <th>{{trans('suporvisor_raport.supervisor.speciality')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supervisors as $supervisor)
                        <tr>
                            <td>{{ $supervisor->firstname_ar }} {{$supervisor->lastname_ar}}</td>
                            <td>{{ $supervisor->grade }}</td>
                            <td>{{ $supervisor->speciality }}</td>
                            <td>{{ $supervisor->faculty }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="additional-section">
            
            <p>{{trans('suporvisor_raport.project')}}<br> <strong >{{ $project->name }} </ظstrong> </p>
        </div>

        <div class="additional-section">
            <p>{{trans('suporvisor_raport.date_university')}} {{ date('Y', strtotime('-1 year')) }} / {{ date('Y') }}</p>
        </div>

        <div class="additional-section">
            <p>{{trans('suporvisor_raport.testimony')}}</p>
        </div>

        <div class="left-section">
            <p>{{trans('suporvisor_raport.written')}} {{ date('Y-m-d') }}</p>
        </div>

        <div class="center-section">
            <p>{{trans('suporvisor_raport.manager')}}</p>
        </div>
    </div>
</body>
</html>
