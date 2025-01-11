<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdministrativeFiles;
use App\Models\Certificate;
use App\Models\Certificates;
use App\Models\Commission;
use App\Models\Faculty;
use App\Models\Manager;
use App\Models\Project;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\SupervisingTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DataTablesController extends Controller {

    public function managers(Request $request) {
        $faculties = Faculty::all();

        $query = Manager::query();

        $managers = $query->get();

        if($request->ajax()) {

          return DataTables::of($managers)
          ->editColumn('id', function ($manager) {
              return (string) $manager->id;
          })
          ->editColumn('name', function ($manager) {
            return $manager->name;
          })
          ->editColumn('email', function ($manager) {
            return $manager->email;
          })
          ->addColumn('faculty', function ($manager) {
            return Str::limit($manager->faculty->name_ar, 25);
          })
          ->editColumn('created_at', function ($manager) {
            return $manager->created_at->format('Y-m-d');
          })
          ->addColumn('actions', function ($manager) {
            return '
            <a href="javascript:void(0)" class="btn btn-icon border-info text-info bg-white" onclick="editManager(' . $manager->id . ')"><i class="mdi mdi-pencil-outline text-info"></i></a>
            <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteManager(' . $manager->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
            ';
          })
          ->rawColumns(['status','actions'])
          ->make(true);
          }

        return view('dashboard.managers.list')
        ->with('faculties',$faculties);

    }

    public function faculties(Request $request) {
      $faculties = Faculty::all();

      if($request->ajax()) {

        return DataTables::of($faculties)
        ->editColumn('id', function ($faculty) {
            return (string) $faculty->id;
        })
        ->editColumn('name_ar', function ($faculty) {
          return $faculty->name_ar;
        })
        ->editColumn('name_fr', function ($faculty) {
          return $faculty->name_fr;
        })
        ->editColumn('created_at', function ($faculty) {
          return $faculty->created_at->format('Y-m-d');
        })
        ->addColumn('actions', function ($faculty) {
          return '
            <a href="javascript:void(0)" class="btn btn-icon border-info text-info bg-white" onclick="editFaculty(' . $faculty->id . ')"><i class="mdi mdi-pencil-outline text-info"></i></a>
            <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteFaculty(' . $faculty->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
          ';
        })
        ->rawColumns(['actions'])
        ->make(true);
        }

      return view('dashboard.faculties.list');

    }

    public function admins(Request $request) {
        $admins = Admin::all();
        $faculties = Faculty::all();

        if($request->ajax()) {

          return DataTables::of($admins)
          ->editColumn('id', function ($admin) {
              return (string) $admin->id;
          })
          ->editColumn('name', function ($admin) {
            return $admin->name;
          })
          ->editColumn('email', function ($admin) {
            return $admin->email;
          })
          ->addColumn('role', function ($admin) {
            return $admin->role;
          })
          ->editColumn('created_at', function ($admin) {
            return $admin->created_at->format('Y-m-d');
          })
          ->addColumn('actions', function ($admin) {
            return '
            <a href="javascript:void(0)" class="btn btn-icon border-info text-info bg-white" onclick="editAdmin(' . $admin->id . ')"><i class="mdi mdi-pencil-outline text-info"></i></a>
            <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteAdmin(' . $admin->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
            ';
          })
          ->rawColumns(['status','actions'])
          ->make(true);
        }

        return view('dashboard.admin.list')
        ->with('faculties',$faculties);

    }

    public function students(Request $request) {
      $query = Student::query();

      if (auth('student')->check()) {
        $studentGroups = StudentGroup::where('project_id', auth('student')->user()->id)->pluck('student_id');
        $query->whereIn('id', $studentGroups);
      }

      $students = $query->get();

      if($request->ajax()) {

        return DataTables::of($students)
        ->editColumn('id', function ($student) {
            return (string) $student->id;
        })
        ->editColumn('name', function ($student) {
          if (auth('student')->check()) {
            return '<span>' . $student->name . '</span>';
          } else {
            return '<a href="' . (url("dashboard/students/$student->id/profile")) . '">' . $student->name . '</a>';
          }
        })
        ->editColumn('email', function ($student) {
          return $student->email;
        })
        ->editColumn('birthday', function ($student) {
          return $student->birthday;
        })
        ->editColumn('birth', function ($student) {
          return $student->state_of_birth . ' ' . $student->place_of_birth;
        })
        ->editColumn('gender', function ($student) {
          if ($student->gender === 1) {
            return '<span class="badge rounded-pill bg-label-success">'. trans('student.male') .'</span>';
          } else {
            return '<span class="badge rounded-pill bg-label-danger">'. trans('student.female') .'</span>';
          }
        })
        ->editColumn('registration_number', function ($student) {
          return $student->registration_number;
        })
        ->editColumn('created_at', function ($student) {
          return $student->created_at->format('Y-m-d');
        })
        ->addColumn('actions', function ($student) {
          return '
          <a href="'. route('dashboard.student.get',$student->id) .'" class="btn btn-icon border-info text-info bg-white"><i class="mdi mdi-pencil-outline text-info"></i></a>
          <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteStudent(' . $student->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
          ';
          // <a href="'. route("student.downloadJustifyAbsence", $student->id) .'" class="btn btn-outline-primary btn-icon"><span class="mdi mdi-printer-outline"></span></a>
        })
        ->rawColumns(['name','birth','gender','actions'])
        ->make(true);
      }

      return view('dashboard.student.list');
    }

    public function commissions(Request $request) {
      $query = Commission::query();

      $commission = $query->get();

      if($request->ajax()) {

        return DataTables::of($commission)
        ->editColumn('id', function ($commission) {
            return (string) $commission->id;
        })
        ->editColumn('name_ar', function ($commission) {
          return $commission->name_ar;
        })
        ->editColumn('name_fr', function ($commission) {
          return $commission->name_fr;
        })
        ->editColumn('teachers_count', function ($commission) {
          return $commission->teachers->count();
        })
        ->editColumn('projects_count', function ($commission) {
          return $commission->projects->count();
        })
        ->editColumn('teachers_count', function ($commission) {
          return $commission->teachers->count();
        })
        ->editColumn('rejected_projects', function ($commission) {
          return $commission->rejected_projects();
        })
        ->editColumn('accepted_projects', function ($commission) {
          return $commission->accepted_projects();
        })
        ->editColumn('created_at', function ($commission) {
          return $commission->created_at->format('Y-m-d');
        })
        ->addColumn('actions', function ($commission) {
          return '
            <a class="btn btn-icon border-info text-info bg-white" onclick="editCommission(' . $commission->id . ')"><i class="mdi mdi-pencil-outline text-info"></i></a>
            <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteCommission(' . $commission->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
            <a class="btn btn-icon bg-white border border-success" onclick="printCommission(' . $commission->id . ')" ><i class="mdi mdi-printer text-success"></i></a>
            ';
        })
        ->rawColumns(['actions'])
        ->make(true);
      }

      return view('dashboard.commission.list');
    }

    public function projects(Request $request){
      $commissions = Commission::all();

      if ($request->ajax()) {

        // Initialize the base query
        $projects = Project::with(['faculty', 'supervisingTeachers', 'commission']);

        // Apply role-based filtering
        if (auth('admin')->check()) {
            $userRole = auth('admin')->user()->role;
            if ($userRole === 'cde') { // Get Mini Project
                $projects->where('project_classification', 1);
            } elseif ($userRole === 'cati') { // Get Patent Project && Patent Startup Project
                $projects->whereIn('project_classification', [3, 4]);
            } elseif ($userRole === 'incubateur') { // Get Startup Project && Patent Startup Project
                $projects->whereIn('project_classification', [2, 4]);
            }
          }

          if (auth('manager')->check()) { // Show only the manager's student projects
              $projects->where('faculty_id', auth('manager')->user()->faculty_id);
          }

          if (auth('student')->check()) { // Show only the manager's student projects
              $projects->where('id',auth('student')->user()->id);
          }

          // Apply the status filter if provided
          if ($request->has('status') && $request->status != '') {
              $projects->where('status', $request->status);
          }

          if ($request->has('archived') && $request->archived == 1) {
            $projects->where('archived', '1');
          } else {
            $projects->where('archived', '0');
          }

          if ($request->has('trashed') && $request->trashed == 1) {
            $projects->onlyTrashed();
          }

          $projects = $projects->get();
            return DataTables::of($projects)
                ->addColumn('checkbox', function ($project) use ($request) {
                  if ($request->has('archived') && $request->archived == 1) {
                    return '';
                  } else {
                    return '<input type="checkbox" class="form-check-input rounded-2 project-checkbox"  value="' . $project->id . '">';
                  }
                    // return '<input type="checkbox" class="form-check-input rounded-2 project-checkbox"  value="' . $project->id . '">';
                })
                ->addColumn('id', function ($project) {
                    return (string) $project->id;
                })
                ->addColumn('name', function ($project) {
                    // return '<a href="' . url('dashboard/project/' . $project->id) . '">' . $project->name . '</a>';
                    return $project->name;
                })
                ->addColumn('status', function ($project) {
                  $statuses = [
                    0 => trans('project.status_project.rejected'),
                    1 => trans('project.status_project.under_studying'),
                    2 => trans('project.status_project.accepted'),
                    3 => trans('project.status_project.complete_project')
                  ];
                  return $statuses[$project->status] ?? '';
                })
                ->addColumn('faculty', function ($project) {
                    return Str::limit($project->faculty->name_ar, 25);
                })
                ->addColumn('bcm_status', function ($project) {
                  if (auth('manager')->check()) {
                    return $this->getBmcState($project);
                      // if ($project->project_classification != null) {
                      //     if (in_array($project->project_classification, [1, 2, 4]) && $project->status == 2) {
                      //         if ($project->statusAdministrative->isNotEmpty()) {
                      //                 if ($project->statusAdministrative->contains('status', 2)) {
                      //                     return trans('project.status_project.missing');
                      //                 } elseif ($project->statusAdministrative->contains('status', 0)) {
                      //                     return trans('auth/project.Your administrative file is being studied');
                      //                 } else { // all state is 1
                      //                     if ($project->project_tracking == 2 && $project->status_project_tracking == 1) {
                      //                         if ($project->bmc_status == 0) {
                      //                             return trans('project.status_project.enter_bmc_file');
                      //                         } elseif ($project->bmc_status == 1) {
                      //                             return trans('project.status_project.under_studying');
                      //                         } elseif ($project->bmc_status == 2) {
                      //                             return trans('project.status_project.bmc_accepted');
                      //                         } elseif ($project->bmc_status == 3) {
                      //                             return trans('project.status_project.bmc_reformat');
                      //                         } else {
                      //                             return trans('project.administrative.add');
                      //                         }
                      //                     } elseif ($project->project_tracking == 2 && $project->status_project_tracking == 2) {
                      //                         return trans('project.status_project.bmc_accepted');
                      //                     } else {
                      //                         return trans('project.administrative.add');
                      //                     }
                      //                 }
                      //         } else {
                      //             return trans('project.administrative.add');
                      //         }
                      //     } else {
                      //         return trans('project.classification.not_eligible');
                      //     }
                      // } else {
                      //     return trans('project.classification.no_classifi');
                      // }
                  }
                  return 'No';
                })
                // ->addColumn('administrative_file', function ($project) {
                //     if (auth('manager')->check()) {
                //         if (in_array($project->project_classification, [1, 2, 4]) && $project->status == 2) {
                //             if ($project->statusAdministrative->isNotEmpty()) {
                //                     if ($project->statusAdministrative->contains('status', 2)) {
                //                     return '<a href="' . url('project/administrative/' . $project->id . '/add') . '" class="btn btn-primary text-white">' . trans('project.administrative.edit') . '</a>';
                //                     } elseif ($project->statusAdministrative->contains('status', 0)) {
                //                         return trans('auth/project.Your administrative file is being studied');
                //                     } else { // all 1
                //                         return trans('project.administrative.ok');
                //                     }
                //             } else {
                //                 return '<a href="' . url('project/administrative/' . $project->id . '/add') . '" class="btn btn-primary text-white">' . trans('project.administrative.add') . '</a>';
                //             }
                //         } else {
                //             return trans('project.administrative.emty');
                //         }
                //     }
                //     return 'No';
                // })
                ->addColumn('students', function ($project) {
                    if ($project->students->isEmpty()) {
                        return '<a>' . trans('project.no_members') . '</a>';
                    }

                    $studentsHtml = '';
                    foreach ($project->students as $student) {
                        $name = app()->getLocale() === 'ar' ? $student->full_name_ar : $student->full_name_fr;
                        $studentsHtml .= '' . $name . '|';
                    }

                    return '<span data-toggle="tooltip" data-placement="top" title="' . $studentsHtml . '">' . $project->students->count() . '</span>';
                })
                ->addColumn('supervisors', function ($project) {
                    if ($project->supervisingTeachers->isEmpty()) {
                        return '<a>' . trans('supervisor.no_supervisors_available') . '</a>';
                    }

                    $supervisorsHtml = '';
                    foreach ($project->supervisingTeachers as $supervisor) {
                        $name = app()->getLocale() === 'ar'
                            ? $supervisor->firstname_ar . ' ' . $supervisor->lastname_ar
                            : $supervisor->firstname_fr . ' ' . $supervisor->lastname_fr;
                        $supervisorsHtml .= '' . $name . '|';
                    }

                    return '<span data-toggle="tooltip" data-placement="top" title="' . $supervisorsHtml . '">' . $project->supervisingTeachers->count() . '</span>';

                })
                ->addColumn('commission_name', function ($project) {
                    if ($project->commission) {
                        return $project->commission->name_ar .
                            '<div class="p-2"><button class="btn btn-primary btn-sm" onclick="openPrintCommission(' . $project->id . ')">' . trans('app.print') . '</button></div>';
                    } else {
                        return '<button class="btn btn-primary btn-sm" onclick="openAddCommission(' . $project->id . ')">' . trans('commission.add_commission') . '</button>';
                    }
                })
                ->addColumn('actions', function ($project) use ($request) {
                  if (auth('manager')->check()) {

                    $currentDate = now();
                    $startDate = $project->start_date;  // Assuming $project has start_date field
                    $endDate = $project->end_date;  // Assuming $project has end_date field
                    if (!($request->has('trashed') && $request->trashed == 1)) {
                      $html = '<div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">';

                      if ($currentDate < $startDate) {
                          $html .= '<span class="text-info dropdown-item">' . trans('project.edit_soon') . '</span>';
                      } elseif ($currentDate >= $startDate && $currentDate <= $endDate) {
                          $html .= '<a href="' . route('project.edit', $project->id) . '" class="dropdown-item">
                                      <i class="bx bx-edit-alt me-2"></i>' . trans('project.edit_project') . '</a>';
                      } else {
                          $html .= '<span class="text-danger dropdown-item">' . trans('project.edit_closed') . '</span>';
                      }

                      $html .= '<a class="dropdown-item" href="javascript:void(0);" onclick="deleteProject(' . $project->id . ')">
                      <i class="mdi mdi-trash-can-outline me-2"></i>' . trans('project.delete') . '</a>';

                      $html .= '</div></div>';
                      return $html;
                    } else {
                      return '
                      <button class="btn btn-outline-danger btn-icon" href="javascript:void(0);" onclick="deleteProject(' . $project->id . ')"><i class="mdi mdi-delete-forever-outline"></i></button>
                      <button class="btn btn-outline-primary btn-icon" href="javascript:void(0);" onclick="restoreProject(' . $project->id . ')"><i class="mdi mdi-backup-restore"></i></button>
                      ';
                    }

                  } elseif (auth('admin')->check() || auth('teacher')->check()) {

                      $html = '<div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">';

                      if (is_null($project->type_project)) {
                          $html .= '<button class="dropdown-item" onclick="addProjectType(' . $project->id . ')">' . trans('project.add_project_type') . '</button>';
                      } else {
                          $html .= '<button class="dropdown-item" onclick="editProjectType(' . $project->id . ', \'' . addslashes($project->type_project) . '\')">' . trans('project.edit_project_type') . '</button>';
                      }

                      if (is_null($project->project_classification)) {
                        $html .= '<button class="dropdown-item" onclick="addProjectClassification(' . $project->id . ')">' . trans('project.add_project_classification') . '</button>';
                      } else {
                        $html .= '<button class="dropdown-item" onclick="editProjectClassification(' . $project->id . ',' . $project->project_classification .')">' . trans('project.edit_project_classification') . '</button>';
                      }

                      if ($project->project_classification && $project->type_project) {
                        $html .= '<a class="dropdown-item" href="' . url('dashboard/project/' . $project->id) . '/add-project-tracking">' . trans('project.project_tracking') . '</a>';
                      }

                      // if (in_array($project->project_classification, [1, 2, 4])) {
                      //     $html .= '<button class="dropdown-item" onclick="editBmcStuding(' . $project->id . ', \'' . addslashes($project->bmc_status) . '\' , \'' . addslashes($project->bmc) . '\')">' . trans('project.bmc_tracking') . '</button>
                      //               <a class="dropdown-item" href="' . url('dashboard/administrative/' . $project->id) . '">' . trans('project.administrative_tracking') . '</a>';
                      // }

                      $html .= '<a href="' . route('project.edit', $project->id) . '" class="dropdown-item">
                      <i class="bx bx-edit-alt me-2"></i>' . trans('project.edit_project') . '</a>';

                      if ($project->archived == '1') {
                        $html .= '<button class="dropdown-item" onclick="archiveProject(' . $project->id . ')">' . trans('project.restore') . '</button>';
                      } else {
                        $html .= '<button class="dropdown-item" onclick="archiveProject(' . $project->id . ')">' . trans('project.archive') . '</button>';
                      }

                      $html .= '</div></div>';
                      return $html;
                  } else {
                    return '';
                  }

                })
                ->editColumn('created_at', function ($project) {
                    return $project->created_at->format('Y-m-d');
                })
                ->rawColumns(['checkbox','bcm_status','administrative_file','bmc_status', 'name', 'status', 'manager_name', 'students', 'supervisors', 'commission_name', 'actions'])
                ->make(true);
        }

            return view('dashboard.project.list')
            ->with('commissions',$commissions);

    }

    public function supervisors(Request $request) {

      $supervisors = SupervisingTeacher::all();

      if($request->ajax()) {

        return DataTables::of($supervisors)
        ->editColumn('id', function ($supervisor) {
            return (string) $supervisor->id;
        })
        ->editColumn('firstname_ar', function ($supervisor) {
          if (app()->getLocale() === 'ar') {
            return $supervisor->firstname_ar;
          } else {
            return $supervisor->firstname_fr;
          }
        })
        ->editColumn('lastname_ar', function ($supervisor) {
          if (app()->getLocale() === 'ar') {
            return $supervisor->lastname_ar;
          } else {
            return $supervisor->lastname_fr;
          }
        })
        ->editColumn('speciality', function ($supervisor) {
          return $supervisor->speciality;
        })
        ->addColumn('faculty_id', function ($supervisor) {
          if (app()->getLocale() === 'ar') {
            return $supervisor->departement->faculty->name_ar;
          } else {
            return $supervisor->departement->faculty->name_fr;
          }
        })
        ->addColumn('departement_id', function ($supervisor) {
          if (app()->getLocale() === 'ar') {
            return $supervisor->departement->name_ar;
          } else {
            return $supervisor->departement->name_fr;
          }
        })
        ->editColumn('created_at', function ($supervisor) {
          return $supervisor->created_at->format('Y-m-d');
        })
        ->addColumn('actions', function ($supervisor) {
          return '
          <a href="'. route('supervisors.edit',$supervisor->id) .'" class="btn btn-icon border-info text-info bg-white"><i class="mdi mdi-pencil-outline text-info"></i></a>
          <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteSupervisor(' . $supervisor->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
          ';
        })
        ->rawColumns(['actions'])
        ->make(true);
      }

      return view('dashboard.supervisors.list');
    }

    public function teachers(Request $request) {
      $teachers = Teacher::all();

      if($request->ajax()) {

        return DataTables::of($teachers)
        ->editColumn('id', function ($teacher) {
            return (string) $teacher->id;
        })
        ->editColumn('name', function ($teacher) {
          return $teacher->name;
        })
        ->editColumn('email', function ($teacher) {
          return $teacher->email;
        })
        ->editColumn('commission_id', function ($teacher) {
          if (app()->getLocale() === 'ar') {
            return $teacher->commission->name_ar;
          } else {
            return $teacher->commission->name_fr;
          }
        })
        ->editColumn('created_at', function ($teacher) {
          return $teacher->created_at->format('Y-m-d');
        })
        ->addColumn('actions', function ($teacher) {
          return '
          <a href="'. route('teacher.show',$teacher->id) .'" class="btn btn-icon border-info text-info bg-white"><i class="mdi mdi-pencil-outline text-info"></i></a>
          <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteTeacher(' . $teacher->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
          ';
        })
        ->rawColumns(['gender','actions'])
        ->make(true);
      }

      return view('dashboard.teacher.list');

    }

    public function administrative_tracking(Request $request,$id) {
      $administrativeFiles = AdministrativeFiles::where('project_id',$id)->get();

      if($request->ajax()) {

        return DataTables::of($administrativeFiles)
        ->addColumn('checkbox', function ($file) {
            return '<input type="checkbox" class="form-check-input select-row" value="' . $file->id . '">';
        })
        ->editColumn('full_name', function ($file) {
            $name = app()->getLocale() === 'ar' ? $file->student->full_name_ar : $file->student->full_name_fr;
            return e($name);
        })
        ->editColumn('registration_certificate', function ($file) {
            return '<a href="' . asset('storage/public/projects/administrative/registrations_certificates/' . $file->registration_certificate) . '" class="text-black" target="_blank">' . trans('auth/project.download') . '</a>';
        })
        ->editColumn('identification_card', function ($file) {
            return '<a href="' . asset('storage/public/projects/administrative/identifications_cards/' . $file->identification_card) . '" class="text-black" target="_blank">' . trans('auth/project.download') . '</a>';
        })
        ->editColumn('photo', function ($file) {
            return '<img src="' . asset('storage/public/projects/administrative/photos/' . $file->photo) . '" height="70" width="70" alt="" class="img-account-profile rounded-circle">';
        })
        ->editColumn('status', function ($file) {
          if($file->status == 0) {
            return '<span class="badge bg-info border border-info rounded-pill">'. trans('auth/project.status_pending') .'</span>';
          } else if($file->status == 1) {
            return '<span class="badge bg-success border border-success rounded-pill">'. trans('auth/project.status_accepted') .'</span>';
          } else if($file->status == 2) {
            return '<span class="badge bg-danger border border-danger rounded-pill">'. trans('auth/project.status_rejected') .'</span>';
          }
        })
        ->editColumn('created_at', function ($file) {
            return $file->created_at->format('Y-m-d');
        })
        ->rawColumns(['checkbox', 'registration_certificate', 'identification_card', 'photo', 'status'])
        ->make(true);
            // ->addColumn('actions', function ($commission) {
        //   return '
        //     <a class="btn btn-icon border-info text-info bg-white" onclick="editCommission(' . $commission->id . ')"><i class="mdi mdi-pencil-outline text-info"></i></a>
        //     <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteCommission(' . $commission->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
        //     <a class="btn btn-icon bg-white border border-success" onclick="printCommission(' . $commission->id . ')" ><i class="mdi mdi-printer text-success"></i></a>
        //   ';
        // })
        // ->rawColumns(['actions'])
        // ->make(true);
      }

      return view('dashboard.project.administrative_tracking');
    }

    public function project_tracking(Request $request, $id = null) {
      $project = $id ? Project::find($id) : Project::find(auth('student')->user()->id);

      if ($request->ajax()) {
          // Wrap the single project in a collection
          return DataTables::of(collect([$project]))  // Wrapping in collect() to make it a collection
              ->addColumn('name', function ($project) {
                  return '<a href="' . url('dashboard/project/'.$project->id) . '">' . $project->name . '</a>';
              })
              ->addColumn('project_tracking', function ($project) {
                  return $this->getprojectTrackingText($project);
              })
              ->addColumn('status_project_tracking', function ($project) {
                  return $this->getStatusProjectTrackingText($project);
              })
              ->addColumn('actions', function ($project) {
                if (auth('admin')->check() || auth('teacher')->check()) {

                    $edit_project_tracking = '<button class="dropdown-item" onclick="editProjectTracking('. $project->project_classification .','. $project->project_tracking .')" data-bs-toggle="modal" data-bs-target="#editProjectTrackingModal">'
                    . ($project->project_tracking == 0 ? trans('project.project_tracking') : trans('project.edit_project_tracking'))
                    . '</button>';

                    $edit_status_project_tracking = '<button class="dropdown-item" onclick="editStatusProjectTracking('. $project->project_classification .','. $project->project_tracking . ','. $project->status_project_tracking . ')" data-bs-toggle="modal" data-bs-target="#editStatusProjectTrackingModal">'
                    . trans('project.edit_status_project_tracking') . '</button>';

                    return '<div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">' . $edit_project_tracking . $edit_status_project_tracking . '</div>
                    </div>';
                }
                return '';
              })
              ->addColumn('print', function ($project) {
              if($project->project_classification == 1 || $project->project_classification == 2 || $project->project_classification == 4 ){
                    if($project->status_project_tracking == 2) {
                        return '<button onclick="printCertificate(' . $project->id . ')" class="btn btn-primary btn-icon">
                                    <span class="mdi mdi-printer-outline"></span>
                                </button>';
                    } else {
                      return '';
                    }
              } else {
                return '';
              }
              })
              ->rawColumns(['name', 'project_tracking', 'status_project_tracking', 'actions', 'print'])
              ->make(true);
      }


      return view('dashboard.project.project_tracking')
      ->with('project',$project);
    }

    public function certificates(Request $request) {
        $query = Certificate::query();

        if ($request->has('classification') && $request->classification !== 'all') {
          $query->whereHas('project', function ($query) use ($request) {
              $query->where('project_classification', $request->classification);
          });
        }

        $certificates = $query->get();

        if($request->ajax()) {

          return DataTables::of($certificates)
          ->editColumn('id', function ($certificate) {
              return (string) $certificate->id;
          })
          ->editColumn('project_id', function ($certificate) {
            return $certificate->project->name;
          })
          ->editColumn('file_name', function ($certificate) {
            return $certificate->file_name;
          })
          ->addColumn('students', function ($certificate) {
            if ($certificate->project->students->isEmpty()) {
                return '<a>' . trans('project.no_members') . '</a>';
            }

            $studentsHtml = '';
            foreach ($certificate->project->students as $student) {
                $name = app()->getLocale() === 'ar' ? $student->full_name_ar : $student->full_name_fr;
                $studentsHtml .= '' . $name . '|';
            }

            return '<span data-toggle="tooltip" data-placement="top" title="' . $studentsHtml . '">' . $certificate->project->students->count() . '</span>';
          })
          ->editColumn('created_at', function ($certificate) {
            return $certificate->created_at->format('Y-m-d');
          })
          ->addColumn('actions', function ($certificate) {
            return '
            <a  class="btn btn-outline-primary btn-icon" href="'. url("certificate/".$certificate->id) .'/students">
              <span class="mdi mdi-printer-outline"></span>
            </a>
            ';

            // <a href="javascript:void(0)" class="btn btn-icon border-info text-info bg-white" onclick="editAdmin(' . $admin->id . ')"><i class="mdi mdi-pencil-outline text-info"></i></a>
            // <a href="javascript:void(0)" class="btn btn-icon border-danger text-danger bg-white" onclick="deleteAdmin(' . $admin->id . ')"><i class="mdi mdi-trash-can-outline text-danger"></i></a>
          })
          ->rawColumns(['students','actions'])
          ->make(true);
        }

        return view('dashboard.certificate.list');

    }

    public function certificate_students(Request $request,$id) {
      $certificate = Certificate::find($id);

      if($request->ajax()) {
        return DataTables::of($certificate->project->students)
        ->editColumn('id', function ($student) {
            return (string) $student->id;
        })
        ->addColumn('name', function ($student) {
          return app()->getLocale() === 'ar' ? $student->full_name_ar : $student->full_name_fr;
        })
        ->addColumn('file_name', function ($student) use ($certificate) {
          return $certificate->file_name;
        })
        ->addColumn('actions', function ($student) use ($certificate) {
          return '
          <a href="javascript:void(0);" onclick="printCertificate(\''.url("print/certificate/students/". $certificate->id .'/'. $student->id).'\')" class="btn btn-outline-primary btn-icon">
              <span class="mdi mdi-printer-outline"></span>
          </a>
          ';
        })


        ->rawColumns(['actions'])
        ->make(true);
      }

      return view('dashboard.certificate.students')
      ->with('certificate',$certificate);

    }
}
