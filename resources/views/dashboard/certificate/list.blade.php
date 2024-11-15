

@extends('layouts/contentNavbarLayout')

@section('title', trans('certificate.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('certificate.dashboard') }} /</span> {{ trans('certificate.certificates') }}
    </h4>

    <div class="card">
        <h5 class="card-header">{{ trans('certificate.certificates') }}</h5>
        <div class="card-body">


        <div class="row mb-4">
          
          <div class="input-group input-group-merge my-w-fit-content m-1">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" id="dataTables_my_filter" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
          </div>
          
          {{-- <div class="my-w-fit-content">
              <button type="button" class="btn btn-outline-primary btn-icon" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                  <span class="mdi mdi-plus"></span>
              </button>
          </div> --}}

            <select class="form-select my-w-fit-content m-1" id="dataTables_my_length">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100" selected>100</option>
            </select>

            <select class="form-select my-w-fit-content m-1" id="selectProjectClassification" name="project_classification" aria-label="Default select example">
                <option value="all">{{ trans('app.all') }}</option>
                <option value="1">{{ trans('project.mini_project') }}</option>
                <option value="2">{{ trans('project.start_up') }}</option>
                <option value="3">{{ trans('project.patent') }}</option>
            </select>

            <button type="button" class="btn btn-outline-primary btn-icon m-1" id="downloadWithStatus" onclick="exportCertificatesExcel()">
              <span class="mdi mdi-download-outline"></span>
            </button>

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
                        <th>{{ trans('auth/project.name_project') }}</th>
                        <th>{{ trans('certificate.file') }}</th>
                        <th>{{ trans('student.members') }}</th>
                        <th>{{ trans('app.created') }}</th>
                        @if (auth('admin')->check())
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
              <ul class="pagination mb-0" id="dataTables_my_paginate" dir="ltr">
              </ul>
            </nav>
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


  function exportCertificatesExcel() {
    var classification = document.getElementById("selectProjectClassification").value;
    var url = '{{ route("dashboard.certifcates.export") }}' + '?classification=' + encodeURIComponent(classification);
    window.location.href = url;
  }

$(document).ready(function() {

        table = $('#table').DataTable({
          
          pageLength: 100,
          language: {
            "emptyTable": "No data available in table",
            "zeroRecords": "No matching records found"
          },
          ajax: {
            url: "{{ route('certificates') }}",
            data: function(d) {
                d.classification = $('#selectProjectClassification').val();
            }
          },
          columns: [
            {data: 'id', name: '#'},
            {data: 'project_id', name: '{{ trans("auth/project.name_project") }}'},
            {data: 'file_name', name: '{{ trans("certificate.file") }}'},
            {data: 'students', name: '{{ trans("student.members") }}'},
            {data: 'created_at', name: '{{ trans("app.created") }}'},
            @if (auth('admin')->check())
            {data: 'actions', name: '{{ trans("app.actions") }}', orderable: false, searchable: false}
            @endif
          ],
          order: [[5, 'desc']], // Default order by created_at column
          rowCallback: function(row, data) {
              $(row).attr('id', 'certificate_' + data.id);
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

      $('#selectProjectClassification').change(function() {
        table.ajax.reload();
      });

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

    $("#printCertificate").click(function(e) {
        let url = $(this).attr('data-url');
        var printWindow = window.open(url, '_blank', 'height=auto,width=auto');
        printWindow.print();
    });



});

</script>
@endsection
