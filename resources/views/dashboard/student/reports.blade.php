@extends('layouts/contentNavbarLayout')

@section('title', trans('project.title_project'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('project.dashboard') }} /</span> {{ trans('project.raport') }}
    </h4>
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{trans('project.title_project')}}
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">النوع</th>
                            <th scope="col">العدد</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>المشاريع المقبولة</td>
                            <td>{{ $acceptedProjectsCount }}</td>
                        </tr>
                        <tr>
                            <td>المشاريع المرفوضة</td>
                            <td>{{ $rejectedProjectsCount }}</td>
                        </tr>
                        <tr>
                            <td>المشاريع قيد الدراسة</td>
                            <td>{{ $underStudyingProjectsCount }}</td>
                        </tr>
                        <tr>
                            <td>المشاريع التي طُلب اكمالها</td>
                            <td>{{ $completeProjectsCount }}</td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
           
            <div class="form-group col-md-4 mr-5 mt-8">
                <button id="printProjectReport" data-url="{{ url('/dashboard/print/project-report') }}" class="btn btn-primary text-white">
                    <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                </button>
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
            $("#printProjectReport").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection