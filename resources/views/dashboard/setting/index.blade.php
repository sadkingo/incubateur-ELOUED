@extends('layouts/contentNavbarLayout')

@section('title', trans('setting.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
{{-- @include('dashboard.setting.import.student') --}}
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('setting.dashboard') }} /</span> {{ trans('setting.settings') }}
    </h4>
    <div class="card pt-3">
        <div class="card-body">
            <div class="row">
                <h5 class="card-title">{{ trans('setting.students') }}</h5>
                <div class="col-sm-12 col-md-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importAllStudentsFileModal">
                        <span class="bx bxs-file-import"></span>{{ trans('setting.import.all_students') }}
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="importAllStudentsFileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">{{ trans('student.import') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="dropzone" class="dropzone"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                        <button type="submit" class="btn btn-primary" id="uploadAllFileStudentsButton" data-bs-dismiss>{{ trans('app.import') }}</button>
                    </div>
                </div>
        </div>
    </div>

<script>

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone", {
        url: "{{ route('dashboard.all.students.import.excel') }}",
        autoProcessQueue: false,
        acceptedFiles: '.xlsx,.xls',
        addRemoveLinks: true,
        dictDefaultMessage: "{{ __('Drag and drop Excel files here or click to upload') }}",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    myDropzone.on("success", function(file, response) {
        console.log("Success uploading file");
    });

    myDropzone.on("error", function(file, errorMessage) {
        console.error('Error uploading file:', errorMessage);
    });


    $(document).ready(function() {
        $('#uploadAllFileStudentsButton').click(function(event) {
            if (myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: "Error",
                    text: "No files to upload",
                    confirmButtonText: "Ok"
                });
            }
        });
    });
</script>

@endsection
