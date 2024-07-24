@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<style>
    body { margin-top: 20px; background-color: #f2f6fc; color: #69707a; }
    .img-account-profile { height: 5rem; }
    .rounded-circle { border-radius: 50% !important; }
    .card { box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%); }
    .card .card-header { font-weight: 500; }
    .card-header:first-child { border-radius: 0.35rem 0.35rem 0 0; }
    .card-header { padding: 1rem 1.35rem; margin-bottom: 0; background-color: rgba(33, 40, 50, 0.03); border-bottom: 1px solid rgba(33, 40, 50, 0.125); }
    .table-billing-history th, .table-billing-history td { padding-top: 0.75rem; padding-bottom: 0.75rem; padding-left: 1.375rem; padding-right: 1.375rem; }
    .table > :not(caption) > * > *, .dataTable-table > :not(caption) > * > * { padding: 0.75rem 0.75rem; background-color: var(--bs-table-bg); border-bottom-width: 1px; box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg); }
    .switch { position: relative; display: inline-block; width: 60px; height: 34px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 34px; }
    .slider:before { position: absolute; content: ""; height: 26px; width: 26px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; }
    input:checked + .slider { background-color: #2196F3; }
    input:checked + .slider:before { transform: translateX(26px); }
</style>    
<div class="container-xl px-4 mt-4">
    <div class="card mb-4">
        <div class="card-header">{{ trans('auth/project.administrative') }}</div>
        <div class="card-body p-0">
            <div class="table-responsive table-billing-history">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="border-gray-200">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th class="border-gray-200" scope="col">{{ trans('auth/student.name') }}</th>
                            <th class="border-gray-200" scope="col">{{ trans('auth/project.registration_certificate') }}</th>
                            <th class="border-gray-200" scope="col">{{ trans('auth/project.identification_card') }}</th>
                            <th class="border-gray-200" scope="col">{{ trans('auth/project.photo') }}</th>
                            <th class="border-gray-200" scope="col">{{ trans('project.status_administrative') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($administrativeFiles as $file)
                            @if($file->student_group_id == 0)
                                <tr>
                                    <td><input type="checkbox" class="select-row" value="{{ $file->id }}"></td>
                                    @php
                                        $locale = app()->getLocale();
                                        $name = $locale === 'ar' ? $student->firstname_ar . ' ' . $student->lastname_ar : $student->firstname_fr . ' ' . $student->lastname_fr;
                                    @endphp
                                    <td>{{ $name }}</td>
                                    <td>
                                        <a href="{{ asset('storage/public/projects/administrative/registrations_certificates/'.$file->registration_certificate) }}" class="text-black" target="_blank" download>{{ trans('auth/project.registration_certificate_download') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/public/projects/administrative/identifications_cards/'.$file->identification_card) }}" class="text-black" target="_blank" download>{{ trans('auth/project.identification_card_download') }}</a>    
                                    </td>
                                    <td><img src="{{ asset('storage/public/projects/administrative/photos/'.$file->photo) }}" alt="" class="img-account-profile rounded-circle"></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_{{ $file->id }}" id="status_pending_{{ $file->id }}" value="0" {{ $file->status == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_pending_{{ $file->id }}">{{ trans('auth/project.status_pending') }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_{{ $file->id }}" id="status_accepted_{{ $file->id }}" value="1" {{ $file->status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_accepted_{{ $file->id }}">{{ trans('auth/project.status_accepted') }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_{{ $file->id }}" id="status_rejected_{{ $file->id }}" value="2" {{ $file->status == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_rejected_{{ $file->id }}">{{ trans('auth/project.status_rejected') }}</label>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($studentGroups as $group)
                                    @if($group->id == $file->student_group_id)
                                        @php
                                            $locale = app()->getLocale();
                                            $name = $locale === 'ar' ? $group->firstname_ar . ' ' . $group->lastname_ar : $group->firstname_fr . ' ' . $group->lastname_fr;
                                        @endphp
                                        <tr>
                                            <td><input type="checkbox" class="select-row" value="{{ $file->id }}"></td>
                                            <td>{{ $name }}</td>
                                            <td><a href="{{ asset('storage/public/projects/administrative/registrations_certificates/'.$file->registration_certificate) }}" class="text-black" target="_blank">{{ trans('auth/project.registration_certificate_download') }}</a></td>
                                            <td><a href="{{ asset('storage/public/projects/administrative/identifications_cards/'.$file->identification_card) }}" class="text-black" target="_blank">{{ trans('auth/project.identification_card_download') }}</a></td>
                                            <td><img src="{{ asset('storage/public/projects/administrative/photos/'.$file->photo) }}" alt="" class="img-account-profile rounded-circle"></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status_{{ $file->id }}" id="status_pending_{{ $file->id }}" value="0" {{ $file->status == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_pending_{{ $file->id }}">{{ trans('auth/project.status_pending') }}</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status_{{ $file->id }}" id="status_accepted_{{ $file->id }}" value="1" {{ $file->status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_accepted_{{ $file->id }}">{{ trans('auth/project.status_accepted') }}</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status_{{ $file->id }}" id="status_rejected_{{ $file->id }}" value="2" {{ $file->status == 2 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_rejected_{{ $file->id }}">{{ trans('auth/project.status_rejected') }}</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 p-2">
                    <button class="btn btn-secondary" id="under-studying-selected">{{ trans('auth/project.under_studying_selected') }}</button>
                    <button class="btn btn-success" id="accept-selected">{{ trans('auth/project.accept_selected') }}</button>
                    <button class="btn btn-danger" id="reject-selected">{{ trans('auth/project.reject_selected') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function updateStatus(id, status) {
        $.ajax({
            url: "{{ route('update-status') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    
                    // تحديث حالة الـ input
                    $(`input[name="status_${id}"][value="${status}"]`).prop('checked', true);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error("{{ trans('auth/project.status_update_failed') }}");
            }
        });
    }

    function updateSelectedStatus(status) {
        $('.select-row:checked').each(function() {
            var id = $(this).val();
            updateStatus(id, status);
        });
    }

    $(document).ready(function() {
        $('#select-all').click(function() {
            $('.select-row').prop('checked', this.checked);
        });

        $('#under-studying-selected').click(function() {
            updateSelectedStatus(0);  
        });
        $('#accept-selected').click(function() {
            updateSelectedStatus(1);  
        });

        $('#reject-selected').click(function() {
            updateSelectedStatus(2);  
        });

        $('input[type="radio"]').change(function() {
            var id = $(this).attr('name').split('_')[1];
            var status = $(this).val();
            updateStatus(id, status);
        });
    });
</script>

@endsection
