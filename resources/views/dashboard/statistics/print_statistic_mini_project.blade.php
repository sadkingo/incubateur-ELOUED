<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    
    <title>{{ trans('print.title_print.statistic') }}</title>
    <style>
        /* Define your styles for the print page here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            /* margin: 20px auto; */
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

        .card-container {
            margin-bottom: 15px;
            flex: 1 1 calc(25% - 30px);
            max-width: calc(25% - 30px);
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .avatar {
            margin-bottom: 10px;
        }

        .label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .card-title {
            margin: 0;
            font-size: 1.5em;
            text-align: center;
        }

        .stat-change {
            color: green;
            font-weight: bold;
        }

        .details {
            width: 100%;
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: yellow;
            border-radius: 12px;
        }

        .stats {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        @media (max-width: 768px) {
            .card-container {
                flex: 1 1 calc(50% - 30px);
                max-width: calc(50% - 30px);
            }
        }

        @media (max-width: 480px) {
            .card-container {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
        

        @page {
            margin-top: 0;
            margin-bottom: 0;

        }

        @page: first {
            margin-top: 0;
        }

        @page: first {
            margin-top: 0;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
        
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Optional Bootstrap JavaScript (for components like dropdowns) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="header-print-page" style="margin-top: 15px">
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
        <div class="row">
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
                                <table>
                                    <thead>
                                        <tr>
                                            <th>اسم الكلية </th>
                                            <th>عدد المشاريع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($miniProjectStatsByFaculty as $facultyName => $count)
                                            <tr>
                                                <td>{{ $facultyName }}</td>
                                                <td>{{ $count }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-danger"><i class="bx bx-error-circle"></i> {{ trans('dashboard.patent project empty') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
       
    </div>
    
    
    <script>
        window.print();
    </script>

    <script>
        // JavaScript to remove the print page link
        window.onload = function() {
            var links = document.getElementsByTagName("a");
            for (var i = 0; i < links.length; i++) {
                if (links[i].getAttribute("href") === "javascript:window.print()") {
                    links[i].parentNode.removeChild(links[i]);
                    break;
                }
            }
        };
    </script>

</body>

</html>
