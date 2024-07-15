@extends('layouts/contentNavbarLayout')

@section('title', trans('certificate.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    @include('dashboard.certificate.create')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('certificate.dashboard') }} /</span>
        {{ trans('certificate.certificates') }}
    </h4>
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table mb-2">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>{{ trans('student.name') }}</th>
                        <th>{{ trans('certificate.file') }}</th>
                        @if (auth('admin')->check())
                            <th>{{ trans('app.actions') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $student->name }}</td>
                        <td>
                            @if ($student->certificates->isNotEmpty())
                                {{ $student->certificates->first()->file_name }}
                            @else
                                {{ trans('certificate.hasnotcertificate') }}
                            @endif
                        </td>
                        @if (auth('admin')->check())
                            <td>
                            </td>
                        @endif
                    </tr>
                    @if(count($studentGroups))
                        @foreach($studentGroups as $group)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$group->firstname_ar}} {{$group->lastname_ar}}</td>
                                <td>@if ($student->certificates->isNotEmpty())
                                    {{ $student->certificates->first()->file_name }}
                                @else
                                    {{ trans('certificate.hasnotcertificate') }}
                                @endif</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {!! $students->links() !!}
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
            function submitForm() {
                $("#filterStudentForm").submit();
            }
            $("#printCertificate").click(function(e) {
                let url = $(this).attr('data-url');
                var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
                printWindow.print();
            });
        });
    </script>
@endsection
