

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


          @if (auth('admin')->check())
            <div class="row">
                <button class="btn btn-success my-w-fit-content m-1 mb-2" onclick="updateSelectedStatus(2)">{{ trans('project.status_project.accepted') }}</button>
                <button class="btn btn-danger my-w-fit-content m-1 mb-2" onclick="updateSelectedStatus(0)">{{ trans('project.status_project.rejected') }}</button>
                <button class="btn btn-secondary my-w-fit-content m-1 mb-2" onclick="updateSelectedStatus(1)">{{ trans('project.status_project.under_studying') }}</button>
                <button class="btn btn-warning my-w-fit-content m-1 mb-2" onclick="updateSelectedStatus(3)">{{ trans('project.status_project.complete_project') }}</button>
                <a data-bs-toggle="modal" data-bs-target="#addDeadLineModal" class="btn btn-outline-primary text-primary btn-icon m-1 mb-2">
                  <span class="mdi mdi-timer-outline"></span>
                </a>
            </div>
          @endif
          <div class="row mb-4">
            <div class="input-group input-group-merge my-w-fit-content m-1">
              <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
              <input type="text" class="form-control" id="dataTables_my_filter" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
            </div>

            @if (auth('manager')->check())
              <a href="{{ route('project.create') }}" class="btn btn-outline-primary btn-icon m-1">
                <span class="mdi mdi-plus"></span>
              </a>
            @endif

            <select class="form-select my-w-fit-content m-1" id="dataTables_my_length">
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            @if (auth('admin')->check() || auth('teacher')->check() || auth('manager')->check())
            <select class="form-select my-w-fit-content m-1" id="status">
              <option value=""selected>{{ trans('project.status.all') }}</option>
                <option value="0">{{ trans('project.status.rejected') }}</option>
                <option value="1">{{ trans('project.status.under_studying') }}</option>
                <option value="2">{{ trans('project.status.accepted') }}</option>
                <option value="3">{{ trans('project.status.completed') }}</option>
              </select>
            @endif

            @if (auth('admin')->check() || auth('teacher')->check())
              <button type="button" class="btn btn-outline-primary btn-icon m-1" id="downloadWithStatus" onclick="exportProjectExcel()">
                <span class="mdi mdi-download-outline"></span>
              </button>
              <button class="btn btn-icon btn-outline-success m-1" id="archived-button" data-archived="0"><span class="mdi mdi-archive-outline"></span></button>
            @endif

            @if (auth('manager')->check())
              <button class="btn btn-icon btn-outline-danger m-1" id="trash-button" data-trashed="0"><span class="mdi mdi-trash-can-outline"></span></button>
            @endif


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
                      @if (auth('admin')->check())
                        <th scope="col">{{ trans('project.select') }}</th>
                      @endif
                      <th scope="col">#</th>
                      <th scope="col">{{trans('project.label.name')}}</th>
                      <th scope="col">{{trans('auth/auth.code')}}</th>
                      <th scope="col">{{ trans('project.status_project.status')}}</th>
                      <th scope="col">{{trans('student.firstname')}} & {{trans('student.lastname')}}</th>
                      <th scope="col">{{trans('student.groups')}}</th>
                      <th scope="col">{{trans('supervisor.supervisors')}}</th>

                      @if(auth('admin')->check())
                        <th scope="col">{{trans('commission.commission')}}</th>
                      @elseif(auth('manager')->check())
                        <th scope="col">{{ trans('project.status_project.bcm_status') }}</th>
                        <th scope="col">{{ trans('project.administrative_file') }}</th>
                      @endif

                        <th scope="col">{{trans('app.created')}}</th>

                      @if(!auth('student')->check())
                        <th scope="col">{{trans('app.actions')}}</th>
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


{{-- add commission modal --}}
<div class="modal fade" id="addCommissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{ trans('commission.commission') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCommissionForm" action="{{ route('dashboard.projects.store_commission','test') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="addCommissionModalId" />
                    <div class="row mb-4">
                        <div class="col">
                            <label for="faculty" class="form-label">{{ trans('commission.commission') }}</label>
                            <select class="form-select" name="commission_id" required>
                                <option value="">{{ trans('commission.commission') }}</option>
                                @foreach ($commissions as $commission)
                                    <option value="{{ $commission->id }}">{{ app()->getLocale() === 'ar' ? $commission->name_ar :  $commission->name_fr }}</option>
                                @endforeach
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

{{-- add Project Classification modal --}}
<div class="modal fade" id="addProjectClassificationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('project.add_project_classification') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="addProjectClassificationForm" action="{{ route('dashboard.projects.store_classification','test') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" id="addProjectClassificationModalId" />
                  <div class="row mb-4">
                    <div class="col">
                        <label for="project_classification" class="form-label">{{ trans('auth/project.project_classification') }}</label>
                        <select name="project_classification" id="add_project_classification" class="form-control">
                            <option value="">{{ trans('auth/project.select_project_classification') }}</option>
                            <option value="1">{{ trans('auth/project.small_scale_enterprise') }}</option>
                            <option value="2">{{ trans('auth/project.start_up') }}</option>
                            <option value="3">{{ trans('auth/project.patent') }}</option>
                            <option value="4">{{ trans('auth/project.patent_start_up') }}</option>
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

{{-- Edit Project Classification modal --}}
<div class="modal fade" id="editProjectClassificationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('commission.commission') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="editProjectClassificationForm" action="{{ route('dashboard.projects.update_classification','test') }}" method="POST">
                  @method('PUT')
                  @csrf
                  <input type="hidden" name="id" id="editProjectClassificationModalId" />
                  <div class="row mb-4">
                      <div class="col">
                        <label for="project_classification" class="form-label">{{ trans('auth/project.project_classification') }}</label>
                        <select name="project_classification" id="edit_project_classification" class="form-control @error('project_classification') is-invalid @enderror">
                            <option value="">{{ trans('auth/project.select_project_classification') }}</option>
                            <option value="1">{{ trans('auth/project.small_scale_enterprise') }}</option>
                            <option value="2">{{ trans('auth/project.start_up') }}</option>
                            <option value="3">{{ trans('auth/project.patent') }}</option>
                            <option value="4">{{ trans('auth/project.patent_start_up') }}</option>
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

{{-- add Project Type modal --}}
<div class="modal fade" id="addProjectTypeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('project.Add project type for') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="addProjectTypeForm" action="{{ route('dashboard.projects.store_type','test') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" id="addProjectTypeModalId" />
                  <div class="row mb-4">
                      <div class="col">
                        <label for="type_project" class="form-label">{{ trans('auth/project.project_type') }}</label>
                        <select name="type_project" id="add_project_type" class="form-control">
                            <option value="">{{ trans('auth/project.select_project_type') }}</option>
                            <option value="commercial">{{ trans('auth/project.project_commercial') }}</option>
                            <option value="industrial">{{ trans('auth/project.project_industrial') }}</option>
                            <option value="agricultural">{{ trans('auth/project.project_agricultural') }}</option>
                            <option value="service">{{ trans('auth/project.project_service') }}</option>
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

{{-- Edit Project Type modal --}}
<div class="modal fade" id="editProjectTypeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('project.Edit project type for') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="editProjectTypeForm" action="{{ route('dashboard.projects.update_type','test') }}" method="POST">
                  @method('PUT')
                  @csrf
                  <input type="hidden" name="id" id="editProjectTypeModalId" />
                  <div class="row mb-4">
                      <div class="col">
                        <label for="type_project" class="form-label">{{ trans('auth/project.project_type') }}</label>
                        <select name="type_project" id="edit_project_type" class="form-control">
                            <option value="">{{ trans('auth/project.select_project_type') }}</option>
                            <option value="commercial">{{ trans('auth/project.project_commercial') }}</option>
                            <option value="industrial">{{ trans('auth/project.project_industrial') }}</option>
                            <option value="agricultural">{{ trans('auth/project.project_agricultural') }}</option>
                            <option value="service">{{ trans('auth/project.project_service') }}</option>
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


{{-- add Bmc Studing modal --}}
<div class="modal fade" id="editBmcStudingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('project.label.bmc_project') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="editBmcStudingForm" action="{{ route('dashboard.projects.store_status_bmc','test') }}" method="POST">
                  @method('PUT')
                  @csrf
                  <a id="downloadBmcLink" href="#" class="text-black" target="_blank">{{ trans('project.label.download_bmc') }}</a>
                  <input type="hidden" name="id" id="editBmcStudingModalId" />
                  <div class="row mb-4">
                      <div class="col">
                        <label for="bmc_status" class="form-label">{{ trans('auth/project.bmc_status') }}</label>
                        <select name="bmc_status" id="edit_bmc_status" class="form-control">
                            <option value="0">{{ trans('auth/project.select_bmc_status') }}</option>
                            <option value="1">{{ trans('project.status_project.under_studying') }}</option>
                            <option value="2">{{ trans('project.status_project.bmc_accepted') }}</option>
                            <option value="3">{{ trans('project.status_project.bmc_reformat') }}</option>
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

{{-- add Dead Line modal --}}
<div class="modal fade" id="addDeadLineModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">{{ trans('project.add_deadline') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="addDeadLineForm" action="{{ route('dashboard.projects.update_all_dates') }}" method="POST">
                  @csrf
                  <div class="row mb-4">
                      <div class="col">
                        <div class="col-lg-12 col-md-6 mb-2">
                          <label for="start_date" class="form-label">{{ trans('auth/project.start_date') }}</label>
                          <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" placeholder="{{ trans('auth/project.placeholder.start_date') }}">
                      </div>
                      <div class="col-lg-12 col-md-6 mb-2">
                          <label for="end_date" class="form-label">{{ trans('auth/project.end_date') }}</label>
                          <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" placeholder="{{ trans('auth/project.placeholder.end_date') }}">
                      </div>
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


{{-- Add Bmc modal --}}
<div class="modal fade" id="addBmcModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">{{ trans('project.create_bmc') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="addBmcForm" action="{{ url('student/project/storeBmc') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" id="addBmcModalId" />
                  <div class="row mb-4">
                    <div class="form-group">
                      <label for="bmc" class="form-label">{{ trans('auth/project.bmc') }}</label>
                      <input type="file" class="form-control" id="bmc" name="bmc" required>
                    </div>
                  </div>
                  <div class="text-end">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                      <button type="submit" class="btn btn-primary">{{ trans('auth/project.accept') }}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

{{-- Reformat Bmc modal --}}
<div class="modal fade" id="reformatBmcModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">{{ trans('project.update_bmc') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="reformatBmcForm" action="{{ url('student/project/reformatBmc') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" id="reformatBmcModalId" />
                  <div class="row mb-4">
                    <div class="form-group">
                      <label for="bmc">{{trans('project.upload_BMC')}}</label>
                      <input type="file" class="form-control" id="bmc" name="bmc" required>
                  </div>
                  </div>
                  <div class="text-end">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('app.close') }}</button>
                      <button type="submit" class="btn btn-primary">{{ trans('project.update_bmc') }}</button>
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
  var lang = "{{ app()->getLocale() }}";

    function exportProjectExcel() {
        var status = document.getElementById("status").value;
        var url = '{{ route("dashboard.projects.export") }}' + '?status=' + encodeURIComponent(status);
        window.location.href = url;
    }

    function openPrintCommission(projectId) {
        var printWindow = window.open('/dashboard/print/commission/' + projectId, '_blank', 'height=auto,width=auto');
        printWindow.onload = function() {
            printWindow.print();
        };
    }

    function updateStatus(projectId, status) {
        $.ajax({
            type: 'POST',
            url: '{{ route("dashboard.update_project_status") }}',
            data: {
                _token: '{{ csrf_token() }}',
                project_id: projectId,
                status: status
            },
            success: function(response) {
                console.log(response);
                toastr.success('{{ trans('project.status_updated') }}');
            },
            error: function(xhr, status, error) {
                console.error(error);
                toastr.error('{{ trans('project.status_update_failed') }}');
            }
        });
    }

    function updateSelectedStatus(status) {
        var selectedProjects = [];
        $('.project-checkbox:checked').each(function() {
            selectedProjects.push($(this).val());
        });

        if (selectedProjects.length > 0) {
            $.ajax({
                type: 'POST',
                url: '{{ url("dashboard/update_selected_projects_status") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    project_ids: selectedProjects,
                    status: status
                },
                success: function(response) {
                    console.log(response);
                    toastr.success('{{ trans('project.status_updated') }}');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    toastr.error('{{ trans('project.status_update_failed') }}');
                }
            });
        } else {
            toastr.warning('{{ trans('project.no_projects_selected') }}');
        }
    }

    function editProject(id) {
    }

    function openAddCommission(id) {
      $('#addCommissionModal').modal('show');
      $('#addCommissionModalId').val(id);
    }

    function addProjectType(id) {
      $('#addProjectTypeModal').modal('show');
      $('#addProjectTypeModalId').val(id);
    }

    function editProjectType(id,type_id) {
      $('#editProjectTypeModal').modal('show');
      $('#editProjectTypeModalId').val(id);
      $('#edit_project_type').val(type_id);
    }

    function addProjectClassification(id) {
      $('#addProjectClassificationModal').modal('show');
      $('#addProjectClassificationModalId').val(id);
    }

    function editProjectClassification(id,classification_id) {
      $('#editProjectClassificationModal').modal('show');
      $('#editProjectClassificationModalId').val(id);
      $('#edit_project_classification').val(classification_id);
    }
    
    function editBmcStuding(id,bmc_status,bmc) {
      $('#editBmcStudingModal').modal('show');
      $('#editBmcStudingModalId').val(id);
      $('#edit_bmc_status').val(bmc_status);
      $('#downloadBmcLink').attr('href', "{{ asset('storage/public/projects/bmc/') }}" + "/" + bmc);

    }

    function reformatBmc(id) {
      $('#reformatBmcModal').modal('show');
      $('#reformatBmcModalId').val(id);
    }

    function addBmc(id) {
      $('#addBmcModal').modal('show');
      $('#addBmcModalId').val(id);
    }

    


    function deleteProject(id) {
      Swal.fire({
          title: "Do you really want to delete this Project?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Submit",
          cancelButtonText: "Cancel",
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '/project/' + id,
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

    function restoreProject(id) {
      Swal.fire({
          title: "Do you really want to Restore this Project?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Submit",
          cancelButtonText: "Cancel",
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '/project/' + id + '/restore',
                  type: 'GET',
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

    function archiveProject(id) {
      Swal.fire({
          title: "Do you really want to do this Project?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Submit",
          cancelButtonText: "Cancel",
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '/project/' + id + '/archive',
                  type: 'GET',
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
          .append('<li><a onclick="editProject(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline mx-1"></i>{{ trans("app.edit") }}</a></li>')
          .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
          .append('<li><a onclick="deleteProject(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline mx-1"></i>{{ trans("app.delete") }}</a></li>');


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
          
          pageLength: 10,
          language: {
            "emptyTable": "No data available in table",
            "zeroRecords": "No matching records found"
          },
          ajax: {
            url: "{{ route('dashboard.projects') }}",
            data: function(d) {
            d.status = $('#status').val();
            d.trashed = $('#trash-button').data('trashed');
            d.archived = $('#archived-button').data('archived');

          }
          },
          columns: [
            @if (auth('admin')->check())
              { data: 'checkbox', name: '{{trans("app.actions")}}', orderable: false, searchable: false },
            @endif
            { data: 'id', name: '#' },
            { data: 'name', name: '{{trans("project.label.name")}}' },
            { data: 'code', name: '{{trans("auth/auth.code")}}' },
            { data: 'status', name: '{{trans("project.status_project.status")}}' },
            { data: 'manager_name', name: '{{trans("student.firstname")}} & {{trans("student.lastname")}}' },
            { data: 'students', name: '{{trans("student.groups")}}' },
            { data: 'supervisors', name: '{{trans("supervisor.supervisors")}}' },
            @if(auth('admin')->check())
            { data: 'commission_name', name: '{{trans("commission.commission")}}' },
            @elseif(auth('manager')->check())
              { data: 'bcm_status', name: '{{ trans("project.status_project.bcm_status") }}' },
              { data: 'administrative_file', name: '{{ trans("project.administrative_file") }}' },
            @endif

            { data: 'created_at', name: '{{trans("app.created")}}' },

            @if(!auth('student')->check())
              { data: 'actions', name: '{{trans("app.actions")}}', orderable: false, searchable: false }
            @endif
          ],
          order: [[8, 'desc']], // Default order by created_at column
          rowCallback: function(row, data) {
              $(row).attr('id', 'project_' + data.id);

              // $(row).on('contextmenu', function(e) {
              //     e.preventDefault();
              //     showContextMenu(data.id, e.pageX, e.pageY);
              // });
              @if(auth('admin')->check())
                var editCell;
                $(row).find('td').eq(4).on('dblclick', function() {
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
                      { value: 0, text: "{{ trans('project.status_project.rejected') }}" },
                      { value: 1, text: "{{ trans('project.status_project.under_studying') }}" },
                      { value: 2, text: "{{ trans('project.status_project.accepted') }}" },
                      { value: 3, text: "{{ trans('project.status_project.complete_project') }}" }
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

      $('#trash-button').on('click', function () {
          const isTrashed = $(this).data('trashed') === 1;

          $(this).data('trashed', isTrashed ? 0 : 1);

          if (isTrashed) {
              $(this).toggleClass('btn-danger');
              $(this).addClass('btn-outline-danger');
          } else {
              $(this).toggleClass('btn-outline-danger');
              $(this).addClass('btn-danger');
          }

          table.ajax.reload();
      });

      $('#archived-button').on('click', function () {
          const isTrashed = $(this).data('archived') === 1;

          $(this).data('archived', isTrashed ? 0 : 1);

          if (isTrashed) {
              $(this).toggleClass('btn-success');
              $(this).addClass('btn-outline-success');
          } else {
              $(this).toggleClass('btn-outline-success');
              $(this).addClass('btn-success');
          }

          table.ajax.reload();
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

      $('#addCommissionForm').submit(function(event) {
        $('#addCommissionModal').modal('hide');

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

      $('#addProjectClassificationForm').submit(function(event) {
        $('#addProjectClassificationModal').modal('hide');

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

      $('#editProjectClassificationForm').submit(function(event) {
        $('#editProjectClassificationModal').modal('hide');

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

      $('#addProjectTypeForm').submit(function(event) {
        $('#addProjectTypeModal').modal('hide');

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

      $('#editProjectTypeForm').submit(function(event) {
        $('#editProjectTypeModal').modal('hide');

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

      $('#editBmcStudingForm').submit(function(event) {
        $('#editBmcStudingModal').modal('hide');

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

      $('#addDeadLineForm').submit(function(event) {
        $('#addDeadLineModal').modal('hide');

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

      $('#addBmcForm').submit(function(event) {
        event.preventDefault();
        $('#addBmcModal').modal('hide');


        var formData = new FormData(this);

        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          dataType: 'json',
          processData: false,           // Don't process the data
          contentType: false,           // Don't set content type header
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

      $('#reformatBmcForm').submit(function(event) {
        event.preventDefault();
        $('#reformatBmcModal').modal('hide');


        var formData = new FormData(this);

        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          dataType: 'json',
          processData: false,  // Prevent jQuery from processing the data
          contentType: false,  // Prevent jQuery from setting contentType
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
