@extends('layouts/contentNavbarLayout')

@section('title', trans('project.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('project.dashboard') }} /</span> {{ trans('auth/project.administrative') }}
    </h4>

    <div class="card">
        <h5 class="card-header">{{ trans('auth/project.administrative') }}</h5>
        <div class="card-body">


        <div class="row mb-4">
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
            
            <button class="btn btn-secondary my-w-fit-content m-1" id="under-studying-selected">{{ trans('auth/project.under_studying_selected') }}</button>
            <button class="btn btn-success my-w-fit-content m-1" id="accept-selected">{{ trans('auth/project.accept_selected') }}</button>
            <button class="btn btn-danger my-w-fit-content m-1" id="reject-selected">{{ trans('auth/project.reject_selected') }}</button>

            {{-- <select class="form-select my-w-fit-content mx-1" id="status">
              <option value=""selected>{{ trans('project.status.all') }}</option>
              <option value="0">{{ trans('project.status.rejected') }}</option>
              <option value="1">{{ trans('project.status.under_studying') }}</option>
              <option value="2">{{ trans('project.status.accepted') }}</option>
              <option value="3">{{ trans('project.status.completed') }}</option>
            </select> --}}

            {{-- <button type="button" class="btn btn-outline-primary btn-icon" id="printWithStatus">
                <span class="mdi mdi-printer-outline"></span>
            </button> --}}

            <div class="dropdown dropdown-menu-end my-w-fit-content p-0">
              <button class="btn btn-icon btn-outline-primary m-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" >
                <span class="mdi mdi-filter-outline"></span>
              </button>
              <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton1" id="columns_filter_dropdown">
              </ul>
          </div>


        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-borderless table-striped table-hover mb-2" id="table">
                <thead>
                    <tr class="text-nowrap">
                        <th><input class="form-check-input" type="checkbox" id="select-all"></th>
                        <th scope="col">{{ trans('project.status_administrative') }}</th>
                        <th scope="col">{{ trans('auth/student.name') }}</th>
                        <th scope="col">{{ trans('auth/project.photo') }}</th>
                        <th scope="col">{{ trans('auth/project.registration_certificate') }}</th>
                        <th scope="col">{{ trans('auth/project.identification_card') }}</th>
                        <th scope="col">{{trans('app.created')}}</th>
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


  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<style>
  .input-group:focus-within {
      box-shadow: none!important;
  }

  .table > :not(:first-child) {
    border: 0!important;
  }
</style>

<script type="text/javascript">
  var table;
  var lang = "{{ app()->getLocale() }}";

    function updateStatus(projectId, status) {
        $.ajax({
            type: 'POST',
            url: '{{ route("update-status") }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: projectId,
                status: status
            },
            success: function(response) {
                console.log(response);
                toastr.error(response.message);
            },
            error: function(xhr, status, error) {
                console.error(error);
                toastr.error("{{ trans('auth/project.status_update_failed') }}");
            }
        });
    }

    function updateSelectedStatus(status) {
        $('.select-row:checked').each(function() {
            var id = $(this).val();
            updateStatus(id, status);
        });
        table.ajax.reload();
    }

    // function updateSelectedStatus(status) {
    //     var selectedProjects = [];
    //     $('.project-checkbox:checked').each(function() {
    //         selectedProjects.push($(this).val());
    //     });

    //     if (selectedProjects.length > 0) {
    //         $.ajax({
    //             type: 'POST',
    //             url: '{{ url("dashboard/update_selected_projects_status") }}',
    //             data: {
    //                 _token: '{{ csrf_token() }}',
    //                 project_ids: selectedProjects,
    //                 status: status
    //             },
    //             success: function(response) {
    //                 console.log(response);
    //                 toastr.success('{{ trans('project.status_updated') }}');
    //                 location.reload();
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(error);
    //                 toastr.error('{{ trans('project.status_update_failed') }}');
    //             }
    //         });
    //     } else {
    //         toastr.warning('{{ trans('project.no_projects_selected') }}');
    //     }
    // }

$(document).ready(function() {

        table = $('#table').DataTable({
          
          pageLength: 100,
          language: {
            "emptyTable": "No data available in table",
            "zeroRecords": "No matching records found"
          },
          ajax: {
            url: "{{ route('administrative.tracking', $project->id) }}",
            type: 'GET'
            },
          columns: [
            { data: 'checkbox', name: '#',orderable: false, searchable: false },
            { data: 'status', name: '{{trans("supervisor.supervisors")}}' },
            { data: 'full_name', name: '{{trans("project.label.name")}}' },
            { data: 'photo', name: '{{trans("student.groups")}}' },
            { data: 'registration_certificate', name: '{{trans("project.status_project.status")}}' },
            { data: 'identification_card', name: '{{trans("student.firstname")}} & {{trans("student.lastname")}}' },
            { data: 'created_at', name: '{{trans("app.created")}}' },
          ],
          order: [[6, 'desc']], // Default order by created_at column
          rowCallback: function(row, data) {
              $(row).attr('id', 'project_' + data.id);

                var editCell;
                $(row).find('td').eq(1).on('dblclick', function() {
                  var cell = $(this);

                  if (cell.find('select').length > 0) {
                      return; // Exit if already in edit mode
                  }

                  // Hide any previously open select
                  if (editCell) {
                      editCell.html(editCell.data('originalValue'));
                  }

                  var originalValue = cell.text();
                  var statuses = [
                      { value: 0, text: "{{ trans('auth/project.status_pending') }}" },
                      { value: 1, text: "{{ trans('auth/project.status_accepted') }}" },
                      { value: 2, text: "{{ trans('auth/project.status_rejected') }}" },
                  ];

                  // Create select element
                  var select = $('<select>', {
                      class: 'form-control',
                      'data-id': data.id
                  }).css('width', '100%');

                  // Add options to the select dropdown
                  statuses.forEach(function(option) {
                      select.append($('<option>', {
                          value: option.value,
                          text: option.text,
                          selected: option.text === originalValue // Select if matches original value
                      }));
                  });

                  cell.html(select);
                  select.focus();

                  // Store the original value
                  cell.data('originalValue', originalValue);

                  // Store the current edit cell
                  editCell = cell;

                  // Handle the select change or blur event
                  select.on('change blur', function(e) {
                      var newValue = $(this).val();
                      var newText = $(this).find('option:selected').text();

                      // Only proceed if the value has changed
                      if (newText !== originalValue) {
                        updateStatus(data.id, newValue)
                          // $.ajax({
                          //     url: '/project/' + data.id + '/update/status', // Update with your actual route
                          //     type: 'POST',
                          //     headers: {
                          //         'X-CSRF-TOKEN': csrfToken
                          //     },
                          //     data: { status: newValue },
                          //     success: function(response) {
                          //         cell.text(newText);
                          //         Swal.fire({
                          //             icon: response.icon,
                          //             title: response.state,
                          //             text: response.message,
                          //             confirmButtonText: "{{ __('Ok') }}"
                          //         });
                          //     },
                          //     error: function(xhr) {
                          //         const response = JSON.parse(xhr.responseText);
                          //         Swal.fire({
                          //             icon: response.icon,
                          //             title: response.state,
                          //             text: response.message,
                          //             confirmButtonText: "{{ __('Ok') }}"
                          //         });
                          //         cell.text(originalValue); // revert back on error
                          //     }
                          // });
                      } else {
                          cell.text(originalValue);
                      }

                      // Hide the select

                      editCell.html(editCell.data('originalValue'));
                      editCell.text(newText);
                      editCell = null;
                  });
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
              '<li><label class="mb-1"><input type="checkbox" class="form-check-input column-toggle" data-column="' + columnIndex + '" checked> ' + columnName + '</label></li>'
          );
      });

      $('#columns_filter_dropdown').on('change', '.column-toggle', function() {
          var column = table.column($(this).data('column'));
          var isChecked = $(this).is(':checked');

          // Toggle the visibility of the column
          column.visible(isChecked);
      });


      $('#status').on('change', function() {
        // Redraw the table to apply the filter
        table.ajax.reload();
      });

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

    $('#addCommissionForm').submit(function(event) {

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
