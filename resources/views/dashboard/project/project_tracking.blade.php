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
                        <th scope="col">{{trans('app.actions')}}</th>
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




<!-- Edit Project Tracking Modal -->
<div class="modal fade" id="editProjectTrackingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{ trans('project.add_project_tracking') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProjectTrackingForm" action="{{ url('dashboard/project/'.$project->id.'/edit-project-tracking') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col">
                            <label for="project_tracking" class="form-label">{{ trans('auth/project.project_trackingg') }}</label>
                            <select name="project_tracking" id="project_tracking" class="form-control">
                                <option value="">{{ trans('auth/project.project_tracking.select_a_stage') }}</option>
                                <!-- Options will be added dynamically via JS -->
                            </select>
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


<!-- Edit Status Project Tracking Modal -->
<div class="modal fade" id="editStatusProjectTrackingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{ trans('auth/project.project_trackingg') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStatusProjectTrackingForm" action="{{ url('dashboard/project/'.$project->id.'/edit-status-project-tracking') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="project_classification" id="project_classification">
                    <input type="hidden" name="project_tracking" id="project_tracking">
                    <div class="row mb-4">
                        <div class="col">
                            <label for="status_project_tracking" class="form-label">{{ trans('auth/project.project_trackingg') }}</label>
                            <select name="status_project_tracking" id="status_project_tracking" class="form-control">
                                <option value="">{{ trans('auth/project.project_tracking.select_a_stage') }}</option>
                                <!-- Options will be added dynamically via JS -->
                            </select>
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
    function editStatusProjectTracking(project_classification, project_tracking, status_project_tracking) {

        // Get the dropdown element
        const dropdown = document.getElementById('status_project_tracking');

        // Clear existing options
        dropdown.innerHTML = `<option value="">${'{{ trans("auth/project.project_tracking.select_a_stage") }}'}</option>`;

        // Define options based on project_classification and project_tracking
        let options = [];
        if (project_classification === 1 || project_classification === 2) {
            if (project_tracking === 1) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.practice') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.complete') }}" },
                    { value: 3, text: "{{ trans('auth/project.status_project_tracking.not_yet') }}" }
                ];
            } else if (project_tracking === 2 || project_tracking === 3) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.development_mode') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.accomplished') }}" },
                    { value: 3, text: "{{ trans('auth/project.status_project_tracking.not_completed') }}" }
                ];
            } else if (project_tracking === 4) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.not_discussed') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.discuss') }}" }
                ];
            } else {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.did_not_happen') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.get') }}" },
                    { value: 3, text: "{{ trans('auth/project.status_project_tracking.exclusion_or_waiver_of_the_student') }}" }
                ];
            }
        } else if (project_classification === 3) {
            if (project_tracking === 1) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.development_mode') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.accomplished') }}" },
                    { value: 3, text: "{{ trans('auth/project.status_project_tracking.not_completed') }}" }
                ];
            } else if (project_tracking === 2 || project_tracking === 3 || project_tracking === 5 || project_tracking === 6 || project_tracking === 7 || project_tracking === 8 || project_tracking === 10) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.no') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.yes') }}" }
                ];
            } else if (project_tracking === 4) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.did_not_happen') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.get') }}" }
                ];
            } else if (project_tracking === 9) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.not_discussed') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.discuss') }}" }
                ];
            }
        } else {
            if (project_tracking === 1) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.practice') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.complete') }}" },
                    { value: 3, text: "{{ trans('auth/project.status_project_tracking.not_yet') }}" }
                ];
            } else if (project_tracking === 2 || project_tracking === 3) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.development_mode') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.accomplished') }}" },
                    { value: 3, text: "{{ trans('auth/project.status_project_tracking.not_completed') }}" }
                ];
            } else if (project_tracking === 4 || project_tracking === 5 || project_tracking === 10) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.no') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.yes') }}" }
                ];
            } else if (project_tracking === 6) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.did_not_happen') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.get') }}" }
                ];
            } else if (project_tracking === 9) {
                options = [
                    { value: 1, text: "{{ trans('auth/project.status_project_tracking.not_discussed') }}" },
                    { value: 2, text: "{{ trans('auth/project.status_project_tracking.discuss') }}" }
                ];
            }
        }

        // Add the options dynamically
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.value;
            opt.text = option.text;
            if (option.value === status_project_tracking) {
                opt.selected = true;
            }
            dropdown.appendChild(opt);
        });
    }


    function editProjectTracking(project_classification, project_tracking) {
        // Define tracking options based on project classification
        const trackingOptions = {
            1: [
                { value: 1, text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                { value: 2, text: "{{ trans('auth/project.project_tracking.create_bmc') }}" },
                { value: 3, text: "{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}" },
                // { value: 4, text: "{{ trans('auth/project.project_tracking.discussion_stage') }}" },
                { value: 5, text: "{{ trans('auth/project.project_tracking.labelle_innovative_project') }}" },
            ],
            2: [
                { value: 1, text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                { value: 2, text: "{{ trans('auth/project.project_tracking.create_bmc') }}" },
                { value: 3, text: "{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}" },
                { value: 4, text: "{{ trans('auth/project.project_tracking.discussion_stage') }}" },
                { value: 5, text: "{{ trans('auth/project.project_tracking.labelle_innovative_project') }}" },
            ],
            3: [
                { value: 1, text: "{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}" },
                { value: 2, text: "{{ trans('auth/project.project_tracking.write_a_descriptive_model') }}" },
                { value: 3, text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                { value: 4, text: "{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}" },
                { value: 5, text: "{{ trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI') }}" },
                { value: 6, text: "{{ trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations') }}" },
                { value: 7, text: "{{ trans('auth/project.project_tracking.obtained_a_patent') }}" },
            ],
            4: [
                { value: 1, text: "{{ trans('auth/project.project_tracking.configuration_stage') }}" },
                { value: 2, text: "{{ trans('auth/project.project_tracking.create_bmc') }}" },
                { value: 3, text: "{{ trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') }}" },
                { value: 4, text: "{{ trans('auth/project.project_tracking.write_a_descriptive_model') }}" },
                { value: 5, text: "{{ trans('auth/project.project_tracking.stage_of_registering_a_patent_application') }}" },
                { value: 6, text: "{{ trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') }}" },
                { value: 7, text: "{{ trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI') }}" },
                { value: 8, text: "{{ trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations') }}" },
                { value: 9, text: "{{ trans('auth/project.project_tracking.discussion_stage') }}" },
                { value: 10, text: "{{ trans('auth/project.project_tracking.obtained_a_patent_startup') }}" },
            ],
        };

        // Get the select element
        const selectElement = document.getElementById('project_tracking');
        
        // Clear existing options
        selectElement.innerHTML = '';

        // Populate the options based on the project classification
        if (trackingOptions[project_classification]) {
            trackingOptions[project_classification].forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                if (option.value == project_tracking) {
                    opt.selected = true;
                }
                selectElement.appendChild(opt);
            });
        }
    }


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
                toastr.success(response.message);
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
                toastr.success(response.message);
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
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
                {data: 'print', name: 'print', orderable: false, searchable: false}
            ],
            rowCallback: function(row, data) {
                $(row).attr('id', 'project_' + data.id);

            },
            drawCallback: function() {
                // Check if the custom row already exists to avoid duplication
                if (!$('#table tbody tr.custom-row').length) {
                    // Append the custom <tr> at the end of the table body
                    $('#table tbody').append('<tr class="custom-row" style="height: 100px;"></tr>');
                }
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



    $('#editStatusProjectTrackingForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        
        // Hide the modal
        $('#editStatusProjectTrackingModal').modal('hide');
        
        // Get the project ID and the selected value
        const projectId = "{{ $project->id }}";
        const statusProjectTracking = $('#status_project_tracking').val();

        // Call the updateStatusProjectTracking function
        updateStatusProjectTracking(projectId, statusProjectTracking);
    });


    $('#editProjectTrackingForm').submit(function(event) {
        event.preventDefault();
        // Hide the modal
        $('#editProjectTrackingModal').modal('hide');

        // Get the project ID and the selected value
        const projectId = "{{ $project->id }}";
        const projectTracking = $('#project_tracking').val();

        // Call the updateStatusProjectTracking function
        updateProjectTracking(projectId, projectTracking);
    });
});

</script>
@endsection





