@php
    use App\Models\StudentGroup;
    $isMenu = false;
    $navbarHideToggle = false;
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
                            {{ trans('app.review') }}
                        </div>
                        {{-- <div class="">
                            @if ($account->tests->count() > 0)
                                <button target="_blank" id="downloadReview"
                                    data-url="{{ route('download.review', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white">
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_review') }}
                                </button>
                                {{-- <button target="_blank" id="downloadCertificate"
                                    data-url="{{ route('download.certificate', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white"
                                >
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_certificate') }}
                                </button>  

                                <a target="_blank"
                                    href="{{ route('download.certificate', [
                                        'student_id' => $account->id,
                                    ]) }}"
                                    class="btn btn-primary text-white">
                                    <span class="bx bxs-download"></span>&nbsp; {{ trans('app.download_certificate') }}
                                </a>
                            @endif
                        </div> --}}
                    </div>
                </h5>
                <hr class="my-0">
                <div class="card-body pt-0">
                    <div class="card-body">
                        <div class="card">
                            <h5 class="card-header pt-0 mt-1">
                                <form action="" method="GET" id="filterStudentForm" class="">
                                    <div class="row">
                                        @if (auth('admin')->check())
                                            <div class="form-group col-md-2 px-1 mt-4">
                                                <a href="{{ route('students.create') }}" class="btn btn-primary text-white">
                                                    <span class="tf-icons bx bx-plus"></span>&nbsp; {{ trans('student.create') }}
                                                </a>
                                            </div>
                                        @endif
                    
                                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="search" class="form-label">{{ trans('app.label.name') }}</label>
                                            <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                                                class="form-control input-solid"
                                                placeholder="{{ Request::get('search') != '' ? '' : trans('app.placeholder.name') }}">
                                        </div>
                                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="registration_number"
                                                class="form-label">{{ trans('student.label.registration_number') }}</label>
                                            <input type="text" id="registration_number" name="registration_number"
                                                value="{{ Request::get('registration_number') }}" class="form-control input-solid"
                                                placeholder="{{ Request::get('registration_number') != '' ? '' : trans('student.placeholder.registration_number') }}">
                                        </div>
                    
                                        <div class="form-group col-md-2 mb-2 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="batch" class="form-label">{{ trans('student.label.batch') }}</label>
                                            <select class="form-select" id="batch" name="batch" aria-label="Default select example">
                                                @if (Request::get('batch') != null)
                                                    <option value="{{ Request::get('batch') }}">
                                                        {{ trans('app.batchs.' . Request::get('batch')) }}</option>
                                                @else
                                                    <option value="">{{ trans('app.select.batch') }}</option>
                                                @endif
                                                <option value="">{{ trans('app.all') }}</option>
                                                <option value="1">{{ trans('app.batchs.1') }}</option>
                                                <option value="2">{{ trans('app.batchs.2') }}</option>
                                                <option value="3">{{ trans('app.batchs.3') }}</option>
                                                <option value="4">{{ trans('app.batchs.4') }}</option>
                                                <option value="5">{{ trans('app.batchs.5') }}</option>
                                                <option value="6">{{ trans('app.batchs.6') }}</option>
                                                <option value="7">{{ trans('app.batchs.7') }}</option>
                                                <option value="8">{{ trans('app.batchs.8') }}</option>
                                                <option value="9">{{ trans('app.batchs.9') }}</option>
                                                <option value="10">{{ trans('app.batchs.10') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="group" class="form-label">{{ trans('student.label.group') }}</label>
                                            <select class="form-select" id="group" name="group" aria-label="Default select example">
                                                @if (Request::get('group') != null)
                                                    <option value="{{ Request::get('group') }}">
                                                        {{ trans('app.groups.' . Request::get('group')) }}</option>
                                                @else
                                                    <option value="">{{ trans('attendence.select.group') }}</option>
                                                @endif
                                                <option value="">{{ trans('app.all') }}</option>
                    
                                                @for ($group = 1; $group <= $groups; $group++)
                                                    <option value="{{ $group }}">{{ trans('app.groups.' . $group) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                    
                                        <div class="form-group col-md-3 mb-2" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="start_date" class="form-label">{{ trans('student.label.start_date') }}</label>
                                            <input type="date" class="form-control input-solid" placeholder="YYYY-MM-DD"
                                                style="background-color: #ffffff" name="start_date" id="start_date"
                                                value="{{ Request::get('start_date') }}" />
                                        </div>
                                        <div class="form-group col-md-3" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                                            <label for="end_date" class="form-label">{{ trans('student.label.end_date') }}</label>
                                            <input type="date" class="form-control input-solid" placeholder="YYYY-MM-DD"
                                                style="background-color: #ffffff" name="end_date" id="end_date"
                                                value="{{ Request::get('end_date') }}" />
                                        </div>
                                        <div class="form-group col-md-2 mb-2">
                                            <label for="year" class="form-label">{{ trans('app.label.year') }}</label>
                                            <select class="form-select" id="year" name="year" aria-label="Default select example">
                                                <option value="">{{ trans('app.select.year') }}</option>
                                                <option value="">{{ trans('app.option.year_all') }}</option>
                                                @for ($i = $start_date; $i <= \Carbon\Carbon::now()->format('Y'); $i++)
                                                    <option value="{{ $i }}" {{ Request::get('year') == $i ? 'selected' : '' }}>
                                                        {{ trans('app.year') . ' ' . $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                    
                                        <div class="form-group col-md-2 mb-2">
                                            <label for="rank" class="form-label">{{ trans('app.label.rank') }}</label>
                                            <select class="form-select" id="rank" name="rank" aria-label="Default select example">
                                                <option value="">{{ trans('app.select.rank') }}</option>
                                                <option value="all" {{ Request::get('rank') == 'all' ? 'selected' : '' }}>{{ trans('app.option.rank_all') }}</option>
                                                <option value="1" {{ Request::get('rank') == 1 ? 'selected' : '' }}>
                                                    {{ trans('app.ranks.1') }}</option>
                                                <option value="2"{{ Request::get('rank') == 2 ? 'selected' : '' }}>
                                                    {{ trans('app.ranks.2') }}</option>
                                                <option value="3"{{ Request::get('rank') == 3 ? 'selected' : '' }}>
                                                    {{ trans('app.ranks.3') }}</option>
                                            </select>
                                        </div>
                    
                                        <div class="form-group col-md-2 mb-2">
                                            <label for="passport" class="form-label">{{ trans('app.label.passport') }}</label>
                                            <select class="form-select" id="passport" name="passport" aria-label="Default select example">
                                                <option value="">{{ trans('app.select.passport') }}</option>
                                                <option value="0" {{ Request::get('passport') == 0 ? 'selected' : '' }}>
                                                    {{ trans('app.no_passport') }}</option>
                                                <option value="1"{{ Request::get('passport') == 1 ? 'selected' : '' }}>
                                                    {{ trans('app.have_passport') }}</option>
                    
                                            </select>
                                        </div>
                                        {{-- perPage  --}}
                                    </div>
                                </form>
                                
                            </h5>
                            
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{trans('project.label.name')}}</th>
                                            <th scope="col">{{ trans('project.status_project.status')}}</th>
                                            <th scope="col">{{trans('student.firstname')}} & {{trans('student.lastname')}}</th>
                                            <th scope="col">{{trans('student.groups')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <th scope="row"> <a href="{{ route('teacher.project.show', $project->id) }}">{{ $project->name }}</a></th>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" class="form-check-input " {{$project->status == 0 ? 'checked' : ''}} onclick="updateStatus({{$project->id}}, 0)">
                                                                <span class="btn btn-sm btn-{{$project->status == 0 ? 'danger' : 'primary'}}">{{trans('project.status_project.rejected')}}</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" {{$project->status == 1 ? 'checked' : ''}} onclick="updateStatus({{$project->id}}, 1)">
                                                                <span class="btn btn-sm btn-{{$project->status == 1 ? 'secondary' : 'primary'}}">{{trans('project.status_project.under_studying')}}</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" {{$project->status == 2 ? 'checked' : ''}} onclick="updateStatus({{$project->id}}, 2)">
                                                                <span class="btn btn-sm btn-{{$project->status == 2 ? 'success' : 'primary'}}">{{trans('project.status_project.accepted')}}</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" class="form-check-input" {{$project->status == 3 ? 'checked' : ''}} onclick="updateStatus({{$project->id}}, 3)">
                                                                <span class="btn btn-sm btn-{{$project->status == 3 ? 'warning' : 'primary'}}">{{trans('project.status_project.complete_project')}}</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{ $project->student->name }}
                                                </td>
                                                <td>
                                                    @php
                                                                    
                                                        $allStudents = StudentGroup::where('id_student', $project->student->id)->get();
                                                    @endphp
                                                    @if($allStudents->count()>0)
                                                        <ul>
                                                            @foreach($allStudents as $student)
                                                                <li>{{ $student->lastname_ar }} {{$student->firstname_ar}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <ul>
                                                            <li>لايوجد اعضاء</li>    
                                                        </ul>    
                                                    @endif
                                                </td>
                                            </tr>
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
       function updateStatus(projectId, status) {
    $.ajax({
        type: 'POST',
        url: '/update_project_status',
        data: {
            _token: '{{ csrf_token() }}',
            project_id: projectId,
            status: status
        },
        success: function(response) {
            console.log(response);
            switch (response.status) {
    case 0:
        $('#project_status').css('background-color', 'red');
        break;
    case 1:
        $('#project_status_button').text('قيد الدراسة');
        break;
    case 2:
        $('#project_message').text('تم قبول المشروع');
        break;
    case 3:
        alert('تم اكتمال المشروع بنجاح!');
        break;
    default:
        break;
}
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
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
