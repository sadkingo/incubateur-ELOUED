@extends('layouts/contentNavbarLayout')

@section('title', trans('project.title'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('project.dashboard') }} /</span> {{ trans('project.projects') }}
    </h4>

    <div class="card">
        <h5 class="card-header">{{ trans('project.projects') }}</h5>
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
                        <th scope="col">{{trans('project.label.name')}}</th>
                        <th scope="col">{{trans('project.project_tracking')}}</th>
                        <th scope="col">{{trans('project.status_project_tracking')}}</th>
                        {{-- <th scope="col">{{trans('app.actions')}}</th> --}}
                        <th scope="col">{{ trans('app.print') }}</th>
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

    @if (auth('admin')->check() || auth('teacher')->check())

    function updateProjectTracking(projectId, project_tracking) {
        $.ajax({
            type: 'PUT',
            url: '{{ route("dashboard.projects.update_tracking","test") }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: projectId,
                project_tracking: project_tracking
            },
            success: function(response) {
                console.log(response);
                toastr.error(response.message);
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
                toastr.error("{{ trans('auth/project.status_update_failed') }}");
            }
        });
    }

    function updateStatusProjectTracking(projectId, status_project_tracking) {
        $.ajax({
            type: 'PUT',
            url: '{{ route("dashboard.projects.update_status_tracking","test") }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: projectId,
                status_project_tracking: status_project_tracking
            },
            success: function(response) {
                console.log(response);
                toastr.error(response.message);
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
                toastr.error("{{ trans('auth/project.status_update_failed') }}");
            }
        });
    }

    @endif
    function printCertificate(id) {
        var printWindow = window.open("{{ url('dashboard/print/certificate') }}/" + id + "/label", '_blank', 'height=auto,width=auto');
        printWindow.onload = function() {
            printWindow.print();
        };
    }

$(document).ready(function() {

        table = $('#table').DataTable({
          
          pageLength: 100,
          language: {
            "emptyTable": "No data available in table",
            "zeroRecords": "No matching records found"
          },
          ajax: {
            url: "{{ route('project.tracking', $project->id) }}",
            },
          columns: [
            {data: 'name', name: 'name'},
            {data: 'project_tracking', name: 'project_tracking'},
            {data: 'status_project_tracking', name: 'status_project_tracking'},
            {data: 'print', name: 'print', orderable: false, searchable: false}
          ],
          order: [[8, 'desc']], // Default order by created_at column
          rowCallback: function(row, data) {
              $(row).attr('id', 'project_' + data.id);
                @if (auth('admin')->check() || auth('teacher')->check())
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
                    let statuses = [];
                        switch(data.project_classification) {
                            case 1:
                            statuses = [
                                    { value: "1", text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                                    { value: "2", text: "{{ trans('auth/project.project_tracking.create_bmc') }}" },
                                    { value: "3", text: "{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}" },
                                    // { value: "4", text: "{{ trans('auth/project.project_tracking.discussion_stage') }}" },
                                    { value: "5", text: "{{ trans('auth/project.project_tracking.labelle_innovative_project') }}" }
                                ];
                                break;
                                
                            case 2:
                            statuses = [
                                    { value: "1", text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                                    { value: "2", text: "{{ trans('auth/project.project_tracking.create_bmc') }}" },
                                    { value: "3", text: "{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}" },
                                    { value: "4", text: "{{ trans('auth/project.project_tracking.discussion_stage') }}" },
                                    { value: "5", text: "{{ trans('auth/project.project_tracking.labelle_innovative_project') }}" }
                                ];
                                break;
                                
                            case 3:
                            statuses = [
                                    { value: "1", text: "{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}" },
                                    { value: "2", text: "{{ trans('auth/project.project_tracking.write_a_descriptive_model') }}" },
                                    { value: "3", text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                                    { value: "4", text: "{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}" },
                                    { value: "5", text: "{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}" },
                                    { value: "6", text: "{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}" },
                                    { value: "7", text: "{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}" }
                                ];
                                break;
                                
                            default:
                            statuses = [
                                    { value: "1", text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                                    { value: "2", text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                                    { value: "3", text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                                    { value: "4", text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                                    { value: "5", text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                                    { value: "6", text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                                    { value: "7", text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                                    { value: "8", text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                                    { value: "9", text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                                    { value: "10", text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" }
                                ];
                        }

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
                            updateProjectTracking(data.id, newValue)
                        } else {
                            cell.text(originalValue);
                        }

                        // Hide the select

                        editCell.html(editCell.data('originalValue'));
                        editCell.text(newText);
                        editCell = null;
                    });
                    });

                    $(row).find('td').eq(2).on('dblclick', function() {
                        var cell = $(this);

                        if (cell.find('select').length > 0) {
                            return; // Exit if already in edit mode
                        }

                        // Hide any previously open select
                        if (editCell) {
                            editCell.html(editCell.data('originalValue'));
                        }

                        var originalValue = cell.text();
                        var statuses = [];
                        switch (data.project_classification) {
                            case 1:
                            case 2:
                                switch (data.project_tracking) {
                                    case 1:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.practice') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.complete') }}" },
                                            { value: "3", text: "{{ trans('auth/project.status_project_tracking.not_yet') }}" },
                                        ];
                                        break;
                                    case 2:
                                    case 3:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.development_mode') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.accomplished') }}" },
                                            { value: "3", text: "{{ trans('auth/project.status_project_tracking.not_completed') }}" },
                                        ];
                                        break;
                                    case 4:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.not_discussed') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.discuss') }}" },
                                        ];
                                        break;
                                    default:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.did_not_happen') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.get') }}" },
                                            { value: "3", text: "{{ trans('auth/project.status_project_tracking.exclusion_or_waiver_of_the_student') }}" },
                                        ];
                                        break;
                                }
                                break;


                            case 3:
                                switch (data.project_tracking) {
                                    case 1:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.development_mode') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.accomplished') }}" },
                                            { value: "3", text: "{{ trans('auth/project.status_project_tracking.not_completed') }}" },
                                        ];
                                        break;
                                    case 2:
                                    case 3:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.no') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.yes') }}" },
                                        ];
                                        break;
                                    case 4:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.did_not_happen') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.get') }}" },
                                        ];
                                        break;
                                    case 5:
                                    case 6:
                                    case 7:
                                    case 8:
                                    case 9:
                                    case 10:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.no') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.yes') }}" },
                                        ];
                                        break;
                                    default:
                                        statuses = [];
                                        break;
                                }
                                break;

                            default:
                                switch (data.project_tracking) {
                                    case 1:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.practice') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.complete') }}" },
                                            { value: "3", text: "{{ trans('auth/project.status_project_tracking.not_yet') }}" },
                                        ];
                                        break;
                                    case 2:
                                    case 3:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.development_mode') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.accomplished') }}" },
                                            { value: "3", text: "{{ trans('auth/project.status_project_tracking.not_completed') }}" },
                                        ];
                                        break;
                                    case 4:
                                    case 5:
                                    case 7:
                                    case 8:
                                    case 10:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.no') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.yes') }}" },
                                        ];
                                        break;
                                    case 6:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.did_not_happen') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.get') }}" },
                                        ];
                                    case 9:
                                        statuses = [
                                            { value: "1", text: "{{ trans('auth/project.status_project_tracking.not_discussed') }}" },
                                            { value: "2", text: "{{ trans('auth/project.status_project_tracking.discuss') }}" },
                                        ];
                                    default:
                                        statuses = [];
                                        break;
                                }
                                break;
                            }



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
                                updateStatusProjectTracking(data.id, newValue)
                            } else {
                                cell.text(originalValue);
                            }

                            // Hide the select

                            editCell.html(editCell.data('originalValue'));
                            editCell.text(newText);
                            editCell = null;
                        });
                    });
                @endif

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

});

</script>
@endsection




