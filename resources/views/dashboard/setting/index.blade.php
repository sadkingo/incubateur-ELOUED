@extends('layouts/contentNavbarLayout')

@section('title', trans('setting.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
@include('dashboard.setting.import.student')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('setting.dashboard') }} /</span> {{ trans('setting.settings') }}
    </h4>
    <div class="card pt-3">
        <div class="card-body">
            <div class="row">
                <h5 class="card-title">{{ trans('setting.students') }}</h5>
                <div class="col-sm-12 col-md-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importStudentFileModal">
                        <span class="bx bxs-file-import"></span>&nbsp; {{ trans('setting.import.student') }}
                    </button>
                </div>
                <div class="col-sm-12 col-md-4">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importAllStudentsFileModal">
                      <span class="bx bxs-file-import"></span>{{ trans('setting.import.all_students') }}
                  </button>
                </div>
                <div class="col-sm-12 col-md-4">
                    {{-- <i class='bx bxs-download'></i> --}}
                    <a href="{{ route('download.studentModel') }}" type="button" class="btn btn-primary">
                        <span class="bx bxs-download"></span>&nbsp; {{ trans('setting.download.student') }}
                    </a>
                </div>
            </div>
            {{-- <p class="card-text">
                <small class="text-muted">Last updated 3 mins ago</small>
            </p> --}}
        </div>
    </div>



    <div class="modal fade" id="importAllStudentsFileModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
          {{-- <form action="{{ route('dashboard.all.students.import.excel') }}" method="POST" enctype="multipart/form-data"> --}}
              {{-- @csrf --}}
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">{{ trans('student.import') }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      {{-- <div class="row">
                          <div class="col-sm-12 col-md-12">
                              <label for="name" class="form-label">{{ trans('student.label.file') }}</label>
                              <input type="file" id="file" name="file" class="form-control">
                          </div>
                      </div> --}}
                      <div id="dropzone" class="dropzone"></div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                      <button type="submit" class="btn btn-primary" id="uploadAllFileStudentsButton" data-bs-dismiss>{{ trans('app.import') }}</button>
                  </div>
              </div>
          {{-- </form> --}}
      </div>
  </div>

  <script>

Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone", {
        url: "{{ route('dashboard.all.students.import.excel') }}",
        autoProcessQueue: false,
        acceptedFiles: '.xlsx,.xls',
        // maxFilesize: 150,
        addRemoveLinks: true,
        // parallelUploads: 15,
        dictDefaultMessage: "{{ __('Drag and drop Excel files here or click to upload') }}",
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    myDropzone.on("success", function(file, response) {
      table.ajax.reload();
    });

    myDropzone.on("error", function(file, errorMessage) {
        console.error('Error uploading file:', errorMessage);
    });


    $(document).ready(function() {
        // Attach the submit handler to the form inside the modal
        // $('#importAllStudentsFileModal form').on('submit', function(event) {
        //     event.preventDefault(); // Prevent the form from submitting the traditional way

        //     var formData = new FormData(this); // Create FormData object with the form data

        //     $.ajax({
        //         url: $(this).attr('action'), // Use the form's action URL
        //         type: $(this).attr('method'), // Use the form's method
        //         data: formData,
        //         dataType: "json",
        //         contentType: false, // Ensure that the content type is not set, for proper FormData handling
        //         processData: false, // Prevent jQuery from automatically processing the data
        //         success: function(response) {
        //             Swal.fire({
        //                 icon: response.icon,
        //                 title: response.state,
        //                 text: response.message,
        //                 confirmButtonText: "Ok"
        //             });
        //         },
        //         error: function(xhr, textStatus, errorThrown) {
        //             const response = JSON.parse(xhr.responseText); // Parse the response to show the error message
        //             Swal.fire({
        //                 icon: response.icon,
        //                 title: response.state,
        //                 text: response.message,
        //                 confirmButtonText: "Ok"
        //             });
        //         }
        //     });
        // });



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
