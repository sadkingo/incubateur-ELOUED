

@extends('layouts/contentNavbarLayout')

@section('title', trans('admin.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('admin.dashboard') }} /</span> {{ trans('admin.admins') }}
    </h4>

    <div class="card">
        <h5 class="card-header">{{ trans('admin.admins') }}</h5>
        <div class="card-body">


        <div class="row mb-4">
          
          <div class="input-group input-group-merge my-w-fit-content m-1">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" id="dataTables_my_filter" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
          </div>
          
          <button type="button" class="btn btn-outline-primary btn-icon m-1" data-bs-toggle="modal" data-bs-target="#createAdminModal">
              <span class="mdi mdi-plus"></span>
          </button>

            <select class="form-select my-w-fit-content m-1" id="dataTables_my_length">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100" selected>100</option>
            </select>

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
                        <th>{{ trans('admin.name') }}</th>
                        <th>{{ trans('admin.email') }}</th>
                        <th>{{ trans('admin.phone') }}</th>
                        <th>{{ trans('admin.label.role') }}</th>
                        <th>{{ trans('app.created') }}</th>
                        <th>{{ trans('app.actions') }}</th>
                    </tr>
                </thead>
            </table>
          </div>
          <div class="row d-flex align-items-center justify-content-end mt-3">
            <div class="my-w-fit-content" id="dataTables_my_info">
            </div>
            <nav class="my-w-fit-content" aria-label="Page navigation">
              <ul class="pagination mb-0" id="dataTables_my_paginate" dir="ltr">
              </ul>
            </nav>
          </div>
      </div>

    </div>





    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">{{ trans('admin.create') }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="addAdminForm" action="{{ route('admin.create') }}" method="POST">
                      @csrf
                      <div class="row mb-4">
                          <div class="col">
                              <label for="name" class="form-label">{{ trans('admin.label.name') }}</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ trans('admin.placeholder.name') }}" required>
                          </div>
                      </div>
                      <div class="row mb-4">
                          <div class="col">
                              <label for="email" class="form-label">{{ trans('admin.label.email') }}</label>
                              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ trans('admin.placeholder.email') }}" required>
                          </div>
                      </div>
                      <div class="row mb-4">
                          <div class="col">
                              <label for="phone" class="form-label">{{ trans('admin.label.phone') }}</label>
                              <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="{{ trans('admin.placeholder.phone') }}" required>
                          </div>
                      </div>
                      <div class="row mb-4">
                          <div class="col">
                              <label for="role" class="form-label">{{ trans('admin.label.role') }}</label>
                              <select class="form-select" name="role" required>
                                      <option value="admin" selected>{{ trans('app.admin.admin') }}</option>
                                      <option value="incubateur">{{ trans('app.admin.incubateur') }}</option>
                                      <option value="cde">{{ trans('app.admin.cde') }}</option>
                                      <option value="cati">{{ trans('app.admin.cati') }}</option>
                              </select>
                          </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group input-group-merge">
                          <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password" required>
                          <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="mdi mdi-lock-outline"></i></span>
                        </div>
                      </div>
                      <div class="text-end">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                          <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="editAdminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{ trans('admin.create') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAdminForm" action="{{ route('admin.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="admin_id" id="admin_id" required />
                    <div class="row mb-4">
                        <div class="col">
                            <label for="name" class="form-label">{{ trans('admin.label.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ trans('admin.placeholder.name') }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="email" class="form-label">{{ trans('admin.label.email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('admin.placeholder.email') }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="phone" class="form-label">{{ trans('admin.label.phone') }}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="{{ trans('admin.placeholder.phone') }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="role" class="form-label">{{ trans('admin.label.role') }}</label>
                            <select class="form-select" id="role" name="role" required>
                                    <option value="admin" selected>{{ trans('app.admin.admin') }}</option>
                                    <option value="incubateur">{{ trans('app.admin.incubateur') }}</option>
                                    <option value="cde">{{ trans('app.admin.cde') }}</option>
                                    <option value="cati">{{ trans('app.admin.cati') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                      <div class="input-group input-group-merge">
                        <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password" required>
                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="mdi mdi-lock-outline"></i></span>
                      </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
                    </div>
                </form>
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

    function editAdmin(id) {
            $.ajax({
                url: '/admin/' + id,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                  admin = data.admin;
                  $('#admin_id').val(admin.id);
                  $('#name').val(admin.name);
                  $('#email').val(admin.email);
                  $('#phone').val(admin.phone);
                  $('#role').val(admin.role);
                  $('#faculty_id').val(admin.faculty_id).change();
                  $('#editAdminModal').modal('show');
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

    function deleteAdmin(id) {
      Swal.fire({
          title: "Do you really want to delete this Admin?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Submit",
          cancelButtonText: "Cancel",
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '/admin/' + id,
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
          .append('<li><a onclick="editAdmin(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline mx-1"></i>{{ trans("app.edit") }}</a></li>')
          .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
          .append('<li><a onclick="deleteAdmin(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline mx-1"></i>{{ trans("app.delete") }}</a></li>');


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
            url: "{{ route('admins') }}",
            // data: function(d) {
            //     d.type = $('#selectType').val();
            // }
          },
          columns: [
              {data: 'id', name: '#'},
              {data: 'name', name: '{{ trans("admin.name") }}'},
              {data: 'email', name: '{{ trans("admin.email") }}'},
              {data: 'phone', name: '{{ trans("admin.phone") }}'},
              {data: 'role', name: '{{ trans("admin.label.role") }}'},
              {data: 'created_at', name: '{{ trans("app.created") }}'},
              {data: 'actions', name: '{{ trans("app.actions") }}', orderable: false, searchable: false}
          ],
          order: [[5, 'desc']], // Default order by created_at column
          rowCallback: function(row, data) {
              $(row).attr('id', 'admin_' + data.id);

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

      $('#addAdminForm').submit(function(event) {
        event.preventDefault();
        $('#createAdminModal').modal('hide');

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

      $('#editAdminForm').submit(function(event) {
        $('#editAdminModal').modal('hide');
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

});

</script>
@endsection
