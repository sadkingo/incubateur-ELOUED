@extends('layouts/contentNavbarLayout')

@section('title', trans('project.create_project'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<style>
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .loading-overlay.show {
        display: flex;
    }
</style>
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ trans('project.dashboard') }} / {{ trans('project.project') }}/ </span>
        {{ trans('project.create_project') }}
    </h4>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ trans('project.create_project') }}</h5>
            <form method="post" action="{{ route('project.store') }}" enctype="multipart/form-data" id="project-form">
                @csrf
                <div id="dynamic-fields">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="name_project" class="form-label">{{ trans('auth/project.name_project') }}</label>
                            <input type="text" class="form-control @error('name_project') is-invalid @enderror"
                                   name="name_project" value="{{ old('name_project') }}"
                                   placeholder="{{ trans('auth/project.placeholder.name_project') }}">
                            @error('name_project')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="description" class="form-label">{{ trans('auth/project.description_project') }}</label>
                            <textarea name="description" id="description" cols="50" rows="0"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            <div id="description_count" class="small text-muted">
                                {{ trans('project.characters_remaining') }}: <span id="chars_left">500</span>
                            </div>
                            @error('description')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="project_image" class="form-label">{{ trans('auth/project.project_images') }}</label>
                            <input type="file" class="form-control @error('project_image.*') is-invalid @enderror"
                                   name="project_image[]" dir="ltr" multiple
                                   placeholder="{{ trans('auth/project.placeholder.project_image') }}">
                            @error('project_image.*')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <label for="video" class="form-label">{{ trans('auth/project.project_video') }}</label>
                            <input type="text" dir="ltr" class="form-control @error('video') is-invalid @enderror"
                                   name="video" value="{{ old('video') }}"
                                   placeholder="{{ trans('auth/project.placeholder.video') }}">
                            @error('video')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="row mt-4">
                          <div class="repeater">
                            <div data-repeater-list="group-a">
                              <div data-repeater-item class="form-group row mb-2">
                                <div class="col-sm-4 col-md-4 mb-2">
                                  <label for="registerd_id" class="form-label">{{ trans('auth/student.registration_number') }}</label>
                                  <input type="text" class="form-control registerd_id" name="registerd_id" placeholder="{{ trans('auth/student.placeholder.registration_number') }}">
                                </div>
                                <div class="col-sm-3 col-md-3 mb-2">
                                  <label for="firstname_ar" class="form-label">{{ trans('auth/student.firstname_ar') }}</label>
                                  <input type="text" class="form-control firstname_ar" name="firstname_ar" placeholder="{{ trans('auth/student.placeholder.firstname_ar') }}" disabled>
                                </div>
                                <div class="col-sm-3 col-md-3 mb-2">
                                  <label for="lastname_ar" class="form-label">{{ trans('auth/student.lastname_ar') }}</label>
                                  <input type="text" class="form-control lastname_ar" name="lastname_ar" placeholder="{{ trans('auth/student.placeholder.lastname_ar') }}" disabled>
                                </div>
                                <div class="col-sm-2 col-md-2 mb-2 d-flex align-items-end">
                                  <button type="button" class="btn btn-danger btn-icon mx-1" data-repeater-delete><span class="mdi mdi-minus"></span></button>
                                </div>
                              </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-icon mx-1" data-repeater-create><span class="mdi mdi-plus"></span></button>
                          </div>

                        </div>


                        <div class="row mt-4">
                          <div class="repeater2">
                            <div data-repeater-list="group-b">
                              <div data-repeater-item class="form-group row mb-2">
                                <div class="col-sm-4 col-md-4 mb-2">
                                  <option value="">{{ trans('supervisor.supervisors') }}</option>
                                  <select class="form-control" name="supervisor_id">
                                    <option value="">{{ trans('supervisor.supervisors') }}</option>
                                    @foreach ($supervisors as $supervisor)
                                      <option value="{{ $supervisor->id }}">{{ $supervisor->firstname_ar }} {{ $supervisor->lastname_ar }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-sm-3 col-md-3 mb-2">
                                  <label for="role" class="form-label">{{ trans('supervisor.role') }}</label>
                                  <select name="supervisor_role" id="supervisor_role" class="form-control @error('supervisor_role') is-invalid @enderror">
                                      <option value="">{{ trans('auth/supertvisor.select_supervisor_role') }}</option>
                                      <option value="1">{{ trans('auth/supertvisor.main_supervisor') }}</option>
                                      <option value="2">{{ trans('auth/supertvisor.second_supervisor') }}</option>
                                      <option value="3">{{ trans('auth/supertvisor.assistant_supervisor') }}</option>
                                  </select>
                                  @error('supervisor_role')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                  @enderror
                                </div>
                                <div class="col-sm-2 col-md-2 mb-2 d-flex align-items-end">
                                  <button type="button" class="btn btn-danger btn-icon mx-1" data-repeater-delete><span class="mdi mdi-minus"></span></button>
                                </div>
                              </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-icon mx-1" data-repeater-create><span class="mdi mdi-plus"></span></button>
                          </div>

                        </div>

                    </div>
                </div>
                <div class="col-sm-12 mt-3 d-flex">
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="submit-button">
                            {{ trans('auth/project.accept') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.repeater@1.2.1/jquery.repeater.min.js"></script>
    <script type="text/javascript">


function debounce(func, delay) {
    let timer;
    return function(...args) {
      clearTimeout(timer);
      timer = setTimeout(() => func.apply(this, args), delay);
    };
  }

  // AJAX search function
  function searchUser($input) {
    let registerdId = $input.val();
    let $row = $input.closest('[data-repeater-item]'); // Get the closest repeater item

    if (registerdId) {
      $.ajax({
        url: '{{ route("dashboard.students.getUserDetailsFromRegisterdId") }}',
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          registerd_id: registerdId
        },
        success: function(response) {
          if (response.success) {
            $row.find('.firstname_ar').val(response.firstname_ar);
            $row.find('.lastname_ar').val(response.lastname_ar);
          } else {
            $row.find('.firstname_ar').val('User not found.');
            $row.find('.lastname_ar').val('User not found.');
          }
        },
        error: function() {
          $row.find('.firstname_ar').val('User not found.');
          $row.find('.lastname_ar').val('User not found.');
        }
      });
    } else {
      // Clear fields if no registerd_id is entered
      $row.find('.firstname_ar').val('');
      $row.find('.lastname_ar').val('');
    }
  }
      $(document).ready(function() {
        // Initialize the repeater
        $('.repeater').repeater({
            initEmpty: false,

            show: function () {
              // Maximum of 5 items
              if ($(this).closest('[data-repeater-list]').children('[data-repeater-item]').length < 6) {
                $(this).slideDown();
              } else {
                alert('Maximum of 5 items allowed.');
              }
            },

            hide: function (deleteElement) {
              // Minimum of 1 item
              if ($(this).closest('[data-repeater-list]').children('[data-repeater-item]').length > 1) {
                $(this).slideUp(deleteElement);
              } else {
                alert('At least one item is required.');
              }
            },
        });



              $(document).on('keyup', '.registerd_id', debounce(function() {
                searchUser($(this));
              }, 500)); // Delay set to 500 ms (half a second)



          $('.repeater2').repeater({
            initEmpty: false,

            show: function () {
              // Maximum of 3 items
              if ($(this).closest('[data-repeater-list]').children('[data-repeater-item]').length < 4) {
                $(this).slideDown();
              } else {
                alert('Maximum of 3 items allowed.');
              }
            },

            hide: function (deleteElement) {
              // Minimum of 1 item
              if ($(this).closest('[data-repeater-list]').children('[data-repeater-item]').length > 1) {
                $(this).slideUp(deleteElement);
              } else {
                alert('At least one item is required.');
              }
            },
        });
      });
    </script>


@endsection

@push('scripts')

@endpush

<!-- Animation Overlay -->
<div class="loading-overlay" id="loading-overlay">
    <div class="loading-spinner"></div>
</div>
