@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('student.dashboard') }} /</span> {{ trans('student.students') }}
    </h4>

    <div class="card">
        <h5 class="card-header">{{ trans('student.students') }}</h5>
        <div class="card-body">


        <div class="row mb-4">
            {{-- <div class="form-group my-w-fit-content">

            </div> --}}

            <div class="input-group input-group-merge my-w-fit-content m-1">
              <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
              <input type="text" class="form-control" id="dataTables_my_filter" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
            </div>

            <select class="form-select my-w-fit-content m-1" id="dataTables_my_length">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100" selected>100</option>
            </select>
            
            @if (auth('admin')->check())
              <a type="button" class="btn btn-outline-primary btn-icon m-1" href="{{ route('students.create') }}">
                <span class="mdi mdi-plus"></span>
              </a>
              <button type="button" class="btn btn-outline-primary btn-icon m-1" data-bs-toggle="modal" data-bs-target="#importAllStudentsFileModal">
                <span class="mdi mdi-upload-outline"></span>
              </button>
            @endif
  
            <div class="dropdown my-w-fit-content p-0">
              <button class="btn btn-icon btn-outline-primary m-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" >
                <span class="mdi mdi-filter-outline"></span>
              </button>
              <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton1" id="columns_filter_dropdown">
              </ul>
          </div>
            {{-- <div class="form-group col-md-4" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
                <form action="" method="GET" id="filterTeacherForm">
                    <label for="search" class="form-label">{{ trans('teacher.label.name') }}</label>
                    <input type="text" id="search" name="search" value="{{ Request::get('search') }}"
                        class="form-control input-solid"
                        placeholder="{{ Request::get('search') != '' ? '' : trans('teacher.placeholder.name') }}">
                </form>
            </div>
            <div class="form-group col-md-2 mr-5 mt-4">
                @if (count($teachers))
                    <button target="_blank" id="printTeacher" data-url="{{ route('dashboard.print.teachers') }}"
                        class="btn
                    btn-primary text-white">
                        <span class="bx bxs-printer"></span>&nbsp; {{ trans('app.print') }}
                    </button>
                @endif
            </div> --}}
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-borderless table-striped table-hover mb-2" id="table">
                <thead>
                    <tr class="text-nowrap">
                      <th>#</th>
                      @if (auth('student')->check())
                        <th>{{ trans('student.name') }}</th>
                      @else
                        <th>{{ trans('student.name') }}</th>
                        <th>{{ trans('student.email') }}</th>
                        <th>{{ trans('student.phone') }}</th>
                        <th>{{ trans('student.birthday') }}</th>
                        <th>{{ trans('student.state_place_of_birth') }}</th>
                        <th>{{ trans('student.gender') }}</th>
                        <th>{{ trans('student.registration_number') }}</th>
                        <th>{{ trans('app.created') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                      @endif
                    </tr>
                </thead>
            </table>
          </div>
          <div class="row d-flex align-items-center justify-content-end mt-3">
            <div class="my-w-fit-content" id="dataTables_my_info">
            </div>
            <nav class="my-w-fit-content" aria-label="Page navigation">
              <ul class="pagination mb-0" id="dataTables_my_paginate">
              </ul>
            </nav>
          </div>
      </div>

    </div>





      {{-- upload all students modal --}}
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



<style>
  .input-group:focus-within {
      box-shadow: none!important;
  }

  .table > :not(:first-child) {
    border: 0!important;
  }
</style>



    {{-- <script src="{{ asset('assets/js/jquery.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}?v={{ time() }}"></script> --}}
<script type="text/javascript">
  var table;
  var lang = "{{ app()->getLocale() }}";

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

    function editStudent(id) {
      window.location.href = "{{ route('dashboard.student.get', ':id') }}".replace(':id', id);
    }

    function deleteStudent(id) {
      Swal.fire({
          title: "Do you really want to delete this Student?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Submit",
          cancelButtonText: "Cancel",
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '/dashboard/student/' + id,
                  type: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                    Swal.fire({
                      icon: response.icon,
                      title: response.state,
                      text: response.message,
                      confirmButtonText: "Ok"
                    });
                    table.ajax.reload();
                  },
                  error: function(xhr, textStatus, errorThrown) {
                      const response = JSON.parse(xhr.responseText);
                      Swal.fire({
                          icon: response.icon,
                          title: response.state,
                          text: response.message,
                          confirmButtonText: "Ok"
                      });
                  }
              });
          }
      });
    }

    function showContextMenu(id, x, y) {

      var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
          .append('<li><a onclick="editStudent(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline mx-1"></i>{{ trans("app.edit") }}</a></li>')
          .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
          .append('<li><a onclick="deleteStudent(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline mx-1"></i>{{ trans("app.delete") }}</a></li>');


      contextMenu.css({
          top: y,
          left: x
      });


      $('body').append(contextMenu);

      $(document).on('click', function() {
        $('.context-menu').remove();
      });
    }

$(document).ready(function() {

        table = $('#table').DataTable({
          
          pageLength: 100,
          language: {
            "emptyTable": "No data available in table",
            "zeroRecords": "No matching records found"
          },
          ajax: {
            url: "{{ route('dashboard.students') }}",
            // data: function(d) {
            //     d.type = $('#selectType').val();
            // }
          },
          columns: [
              {data: 'id', name: '#'},
              @if (auth('student')->check())
                {data: 'name', name: '{{ trans("student.name") }}'},
              @else
                {data: 'name', name: '{{ trans("student.name") }}'},
                {data: 'email', name: '{{ trans("student.email") }}'},
                {data: 'phone', name: '{{ trans("student.phone") }}'},
                {data: 'birthday', name: '{{ trans("student.birthday") }}'},
                {data: 'birth', name: '{{ trans("student.state_place_of_birth") }}'},
                {data: 'gender', name: '{{ trans("student.gender") }}'},
                {data: 'registration_number', name: '{{ trans("student.registration_number") }}'},
                {data: 'created_at', name: '{{ trans("app.created") }}'},
                {data: 'actions', name: '{{ trans("app.actions") }}', orderable: false, searchable: false}
              @endif
          ],
          order: [[8, 'desc']], // Default order by created_at column
          rowCallback: function(row, data) {
              $(row).attr('id', 'Student_' + data.id);

              $(row).on('contextmenu', function(e) {
                  e.preventDefault();
                  showContextMenu(data.id, e.pageX, e.pageY);
              });

          }

      });

      $('#dataTables_my_length').change(function() {
        var selectedValue = $(this).val();
        table.page.len(selectedValue).draw();
      });

      $('#dataTables_my_filter').on('input', function () {
        var query = $(this).val();
        table.search(query).draw();
      });

      // $('#selectType').change(function() {
      //   table.ajax.reload();
      // });

      table.on('draw', function () {
        var info = table.page.info();
        var pagination = $('#dataTables_my_paginate');

        pagination.empty();


        var prevButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link ms-1').attr('href', 'javascript:void(0);').html('<span class="mdi mdi-chevron-left"></span>'));
        if (info.page > 0) {
          prevButton.find('a').click(function () {
            table.page('previous').draw('page');
          });
        } else {
          prevButton.addClass('disabled');
        }
        pagination.append(prevButton);


        for (var i = 0; i < info.pages; i++) {
          var page = i + 1;
          var liClass = (page === info.page + 1) ? 'active' : 'd-none';
          var link = $('<a>').addClass('page-link').attr('href', 'javascript:void(0);').text(page);
          var listItem = $('<li>').addClass('page-item').addClass(liClass).append(link);
          listItem.click((function (pageNumber) {
            return function () {
              table.page(pageNumber).draw('page');
            };
          })(i));
          pagination.append(listItem);
        }


        var nextButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link ms-1').attr('href', 'javascript:void(0);').html('<span class="mdi mdi-chevron-right"></span>'));
        if (info.page < info.pages - 1) {
          nextButton.find('a').click(function () {
            table.page('next').draw('page');
          });
        } else {
          nextButton.addClass('disabled');
        }
        pagination.append(nextButton);


        var startRange = info.start + 1;
        var endRange = info.start + info.length;
        var pageInfo = startRange + ' ' + "to" + ' ' + endRange + ' ' + "from" + ' ' + info.recordsTotal;
        $('#dataTables_my_info').text(pageInfo);

      });

      table.columns().every(function() {
          var column = this;
          var columnName = $(column.header()).text(); // Get the column name from the header
          var columnIndex = column.index(); // Get the column index

          // Append the checkbox to the dropdown
          $('#columns_filter_dropdown').append(
              '<li><label><input type="checkbox" class="form-check-input column-toggle" data-column="' + columnIndex + '" checked> ' + columnName + '</label></li>'
          );
      });

      $('#columns_filter_dropdown').on('change', '.column-toggle', function() {
          var column = table.column($(this).data('column'));
          var isChecked = $(this).is(':checked');

          // Toggle the visibility of the column
          column.visible(isChecked);
      });

      $('#addStudentForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          dataType: 'json',
          success: function(response) {
            Swal.fire({
              icon: response.icon,
              title: response.state,
              text: response.message,
              confirmButtonText: "Ok"
            });
            table.ajax.reload();
          },
          error: function(xhr, textStatus, errorThrown) {
            const response = JSON.parse(xhr.responseText);
            Swal.fire({
              icon: response.icon,
              title: response.state,
              text: response.message,
              confirmButtonText: "Ok"
            });
          }
        });
      });

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
