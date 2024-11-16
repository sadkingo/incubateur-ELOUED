<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\Dashboard\Attendence\AttendenceController;

// use App\Http\Controllers\Dashboard\Commission\CommissionController;
use App\Http\Controllers\Dashboard\Certificate\CertificateController;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Evaluation\EvaluationController;
use App\Http\Controllers\Dashboard\ExcelImport\ExcelImportController;
use App\Http\Controllers\Dashboard\Note\NoteController;
use App\Http\Controllers\Dashboard\Print\PrintController;
use App\Http\Controllers\Dashboard\Project\ProjetController;
use App\Http\Controllers\Dashboard\Setting\SettingController;
use App\Http\Controllers\Dashboard\Statistics\StatisticsController;
use App\Http\Controllers\Dashboard\Student\StudentController;
use App\Http\Controllers\Dashboard\Subject\SubjectController;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Student\AccountController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\StudentController as ControllersStudentController;
use App\Http\Controllers\SupervisingTeacherController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Teacher\ManagerDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\TeacherController;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// define('PAGINATE_COUNT',100);
Session::put('locale', 'ar');
// define('PAGINATE_COUNT',10);
// ['middleware' => ['auth']],
Route::group([], function () {
    Route::get('/theme/{theme}', function ($theme) {
        Session::put('theme', $theme);
        return redirect()->back();
    });

    Route::get('/lang/{lang}', function ($lang) {
        Session::put('locale', $lang);
        App::setLocale($lang);
        return redirect()->back();
    });
});

Route::get('/login', function (Request $request) {
    Session::put('locale', 'ar');
    return to_route('auth.login');
});

/* ----------------------- Start Authentication -----------------------*/
Route::name('auth.')->middleware('guest')->group(function () {
    // Route::get('register', [RegisterController::class, 'registerForm'])->name('registerForm');
    // Route::post('register', [RegisterController::class, 'register'])->name('register');

    // Auth
    Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
    Route::post('login', [LoginController::class, 'submitLogin'])->name('login');
    // Student Auth
    Route::get('login/student', [LoginController ::class, 'loginAsStudent'])->name('loginAsStudent');
    Route::post('login/student', [LoginController::class, 'submitStudentLogin'])->name('login.student');

});

Route::get('logout', LogoutController::class)->middleware('auth:admin,student,teacher,manager')->name('auth.logout');
/* ----------------------- End Authentication -----------------------*/


/* ----------------------- Start Dashboard -----------------------*/

// $adminRoute = env('ADMIN_ROUTE');
// $adminRoute = 'admins';

Route::middleware('auth:admin,teacher,manager,student')->group(function () {

  Route::get('students', [DataTablesController::class, 'students'])->name('dashboard.students');
  Route::get('projects', [DataTablesController::class, 'projects'])->name('dashboard.projects');
  Route::get('supervisors', [DataTablesController::class, 'supervisors'])->name('supervisors');

  // dashboard
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
  Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
  Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
  Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
  Route::get('/dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
  Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
  Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

  // projet
  Route::get('/projet', [ProjetController::class, 'index'])->name('projet.index');
  Route::get('/projet/create', [ProjetController::class, 'create'])->name('projet.create');
  Route::post('/projet', [ProjetController::class, 'store'])->name('projet.store');
  Route::get('/projet/{id}', [ProjetController::class, 'show'])->name('projet.show');
  Route::get('/projet/{id}/edit', [ProjetController::class, 'edit'])->name('projet.edit');
  Route::put('/projet/{id}', [ProjetController::class, 'update'])->name('projet.update');
  Route::delete('/projet/{id}', [ProjetController::class, 'destroy'])->name('projet.destroy');

  // project
  Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
  Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
  Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
  Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
  Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
  Route::put('/project/{id}', [ProjectController::class, 'update'])->name('project.update');
  Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
  Route::get('/project/{id}/archive', [ProjectController::class, 'archive'])->name('project.archive');
  Route::get('/project/{id}/restore', [ProjectController::class, 'restore'])->name('project.restore');

  Route::get('projects/track/{id?}',[DataTablesController::class, 'project_tracking'])->name('project.tracking');

  // account
  Route::get('/account', [AccountController::class, 'index'])->name('account.index');
  Route::get('/account/create', [AccountController::class, 'create'])->name('account.create');
  Route::post('/account', [AccountController::class, 'store'])->name('account.store');
  Route::get('/account/{id}', [AccountController::class, 'show'])->name('account.show');
  Route::get('/account/{id}/edit', [AccountController::class, 'edit'])->name('account.edit');
  Route::put('/account/{id}', [AccountController::class, 'update'])->name('account.update');
  Route::delete('/account/{id}', [AccountController::class, 'destroy'])->name('account.destroy');

  // certificates
  Route::get('/certificates/create', [CertificateController::class, 'create'])->name('certificates.create');
  Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');
  Route::get('/certificates/{id}', [CertificateController::class, 'show'])->name('certificates.show');
  Route::get('/certificates/{id}/edit', [CertificateController::class, 'edit'])->name('certificates.edit');
  Route::put('/certificates/{id}', [CertificateController::class, 'update'])->name('certificates.update');
  Route::delete('/certificates/{id}', [CertificateController::class, 'destroy'])->name('certificates.destroy');

    // students
    // Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    // Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    // Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    // Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    // Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    // Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    // Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/student/{id}/download-Justify-absence', [DocsController::class, 'downloadStudentJustifyAbsence'])->name('student.downloadJustifyAbsence');

    Route::post('/student/upload/photo', [ControllersStudentController::class, 'upload_photo'])->name('student.upload.photo');
    Route::post('students/get-user-details-from-registerd-id', [ControllersStudentController::class, 'getUserDetailsFromRegisterdId'])->name('dashboard.students.getUserDetailsFromRegisterdId');

  //
  Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics.index');

  // students
  Route::get('/supervisors/create', [SupervisingTeacherController::class, 'create'])->name('supervisors.create');
  Route::post('/supervisors', [SupervisingTeacherController::class, 'store'])->name('supervisors.store');
  Route::get('/supervisors/{id}', [SupervisingTeacherController::class, 'show'])->name('supervisors.show');
  Route::get('/supervisors/{id}/edit', [SupervisingTeacherController::class, 'edit'])->name('supervisors.edit');
  Route::put('/supervisors/{id}', [SupervisingTeacherController::class, 'update'])->name('supervisors.update');
  Route::delete('/supervisors/{id}', [SupervisingTeacherController::class, 'destroy'])->name('supervisors.destroy');
  Route::post('supervisor/assign/{id}', [SupervisingTeacherController::class, 'assign'])->name('supervisor.assign');



  Route::get('project/administrative/{id}/add', [ProjectController::class, 'administrative'])->name('project.administrative.add');
  Route::post('project/administrative/{id}/store', [ProjectController::class, 'storeAdministrative'])->name('project.administrative.store');
  // Route::get('student/project/{id}/addBmc', [ProjectController::class, 'addBmcFile'])->name('student.project.addBmc');
  Route::post('student/project/storeBmc', [ProjectController::class, 'storeBmcFile'])->name('student.project.storeBmcFile');
  // Route::get('student/project/{id}/reformatBmc', [ProjectController::class, 'reformatBmcFile'])->name('student.project.reformatBmc');
  Route::post('student/project/reformatBmc', [ProjectController::class, 'updateBmcFile'])->name('student.project.updateBmc');


  
});

// Route::resource('settings', SettingController::class)->middleware('auth:admin');

Route::middleware('auth:admin')->group(function () {

  Route::get('faculties', [DataTablesController::class, 'faculties'])->name('faculties');
  Route::get('managers', [DataTablesController::class, 'managers'])->name('managers');
  Route::get('admins', [DataTablesController::class, 'admins'])->name('admins');
  Route::get('commissions', [DataTablesController::class, 'commissions'])->name('commissions');
  Route::get('teachers', [DataTablesController::class, 'teachers'])->name('teachers');
  Route::get('/certificates', [DataTablesController::class, 'certificates'])->name('certificates');
  Route::get('/certificate/{id}/students',[DataTablesController::class, 'certificate_students'])->name('certificate.students');

  // settings
  Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
  Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
  Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
  Route::get('/settings/{id}', [SettingController::class, 'show'])->name('settings.show');
  Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
  Route::put('/settings/{id}', [SettingController::class, 'update'])->name('settings.update');
  Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');

  // managers
  Route::get('/manager/{id}', [ManagerController::class, 'get'])->name('manager.get');
  Route::post('/manager/create', [ManagerController::class, 'create'])->name('manager.create');
  Route::delete('/manager/{id}', [ManagerController::class, 'delete'])->name('manager.delete');
  Route::post('/manager/update', [ManagerController::class, 'update'])->name('manager.update');

    // faculties
    Route::get('/faculty/{id}', [FacultyController::class, 'get'])->name('faculty.get');
    Route::post('/faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
    Route::delete('/faculty/{id}', [FacultyController::class, 'delete'])->name('faculty.delete');
    Route::post('/faculty/update', [FacultyController::class, 'update'])->name('faculty.update');

    
  // admins
  Route::get('/admin/{id}', [AdminController::class, 'get'])->name('admin.get');
  Route::post('/admin/create', [AdminController::class, 'create'])->name('admin.create');
  Route::delete('/admin/{id}', [AdminController::class, 'delete'])->name('admin.delete');
  Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.update');

  // teachers
  Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
  Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
  Route::get('/teacher/{id}', [TeacherController::class, 'show'])->name('teacher.show');
  Route::put('/teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');
  Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

  // commissions
  Route::get('/commission/{id}', [CommissionController::class, 'get'])->name('commission.get');
  Route::post('/commission/create', [CommissionController::class, 'create'])->name('commission.create');
  Route::delete('/commission/{id}', [CommissionController::class, 'delete'])->name('commission.delete');
  Route::post('/commission/update', [CommissionController::class, 'update'])->name('commission.update');
  Route::get('commission/{id}/students', [CommissionController::class, 'getStudentsInCommission'])->name('commission.students');

});

Route::middleware('auth:admin,teacher')->group(function () {
  Route::get('/administrative-tracking/{id}', [DataTablesController::class, 'administrative_tracking'])->name('administrative.tracking');

  Route::get('/dashboard/projects/export', [ProjectController::class, 'export'])->name('dashboard.projects.export');
  Route::get('/dashboard/certifcates/export', [CertificateController::class, 'export'])->name('dashboard.certifcates.export');

});

Route::middleware('auth:student')->group(function () {
  // Route::get('students/certificates/{id}', [StudentController::class, 'certificates'])->name('student.certificates');
});

// Route::middleware('auth:student,project')->group(function () {
  // Route::get('/account', [AccountController::class, 'index'])->name('account.index');
// });

// Route::get('logout', LogoutController::class)->middleware('auth:admin,student,teacher')
//     ->name('auth.logout');
// Route::get('/manager', [ManagerController::class, 'dash'])->name('manager.dash');

Route::name('student.')->middleware('auth:student')->group(function () {
  // Route::get('student', [StudentDashboardController::class, 'index'])->name('index');
  // Route::get('student/{student_id}', [StudentDashboardController::class, 'indexAdmin'])->name('index.admin');
  // Route::resource('account', AccountController::class);
  // Route::resource('project', ProjectController::class);
  // Route::resource('supervisor', SupervisingTeacherController::class);
  Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
  // Route::delete('account/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
  // Route::put('account/{id}', [AccountController::class, 'update'])->name('account.update');
});

Route::get('print/certificate/student/{id}', [CertificateController::class, 'generateCertificate'])->name('certificate');
Route::get('print/certificate/students/{cid}/{sid}', [CertificateController::class, 'generateStudentCertificate'])->name('student.certificate');
Route::get('print/certificate/{project_id}', [PrintController::class, 'generateCertificate'])->name('print.certificate');
Route::get('print/certificate/{project_id}/{student_id?}', [PrintController::class, 'generateStudentCertificate'])->name('print.certificate.student');



Route::prefix('teacher')->name('teacher.')->middleware('auth:teacher')->group(function () {
  // Route::resource('students', TeacherDashboardController::class);
  // Route::get('projects', [TeacherDashboardController::class, 'projects'])->name('project.projects');
  // Route::get('projects/{project}', [TeacherDashboardController::class, 'showProject'])->name('project.show');
  // Route::post('/update_project_status', [TeacherDashboardController::class, 'updateProjectStatus'])->name('update_project_status');
});



// my edit

Route::name('manager.')->middleware('auth:manager')->group(function () {
Route::get('manager', [ManagerController::class, 'projects'])->name('index');
Route::resource('account', AccountController::class);
// Route::resource('project', ProjectController::class);
// Route::resource('supervisor', SupervisingTeacherController::class);
// Route::resource('students', ManagerDashboardController::class);
// Route::get('projects', [TeacherDashboardController::class, 'projects'])->name('project.projects');
// Route::get('projects/{project}', [TeacherDashboardController::class, 'showProject'])->name('project.show');
// Route::post('/update_project_status', [TeacherDashboardController::class, 'updateProjectStatus'])->name('update_project_status');
});


Route::prefix('download')->middleware('auth:admin,student')->controller(PrintController::class)->name('download.')->group(function () {
  Route::get('reviews/{student_id}', 'review')->name('review');
  Route::get('certificate/{student_id}', 'certificate')->name('certificate');
  Route::get('student/modal', 'studentModel')->middleware('auth:admin')->name('studentModel');

});


Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin,student,teacher,manager')->group(function () {
  Route::get('project/{project}', [ProjetController::class, 'show'])->name('dashboard.project.show');
  Route::prefix('print')->name('print.')->group(function () {
    Route::get('certificate/{id}/label',[PrintController::class, 'label'])->name('label');
  });
});

Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin,teacher,manager')->group(function () {
    // Route::resource('/', DashboardController::class);

    Route::post('/analyse/added', [DashboardController::class, 'analyseGetStudentByYear']);

    Route::post('/analyse/gender', [DashboardController::class, 'analyseGetStudentByGender']);

    Route::post('/analyse/point', [DashboardController::class, 'analyseGetStudentByPoint']);

    Route::post('import-student-excel', [ExcelImportController::class, 'import'])->name('student.import.excel');
    Route::post('import-all-students-excel', [ControllersStudentController::class, 'import'])->name('all.students.import.excel');
    Route::get('students/{student}/profile', [StudentController::class, 'showProfile'])->name('dashboard.students.profile');
    Route::get('students/{id}/edit-stage', [StudentController::class, 'editStage'])->name('dashboard.students.editStage');
    Route::post('students/{id}/updateStage', [StudentController::class, 'updateStage'])->name('dashboard.students.updateStage');

    Route::get('/student/{id}', [ControllersStudentController::class, 'get'])->name('student.get');
    Route::post('/student/create', [ControllersStudentController::class, 'create'])->name('student.create');
    Route::delete('/student/{id}', [ControllersStudentController::class, 'delete'])->name('student.delete');
    Route::post('/student/update', [ControllersStudentController::class, 'update'])->name('student.update');

    // Route::get('project/bmc-studing/{id}', [ProjectController::class,'editStatusBmc'])->name('dashboard.projects.edit_status_bmc');
    Route::put('project/bmc-studing/{id}', [ProjectController::class,'storeStatusBmc'])->name('projects.store_status_bmc');
    Route::get('/get-departments/{facultyId}', [ProjectController::class, 'getDepartments'])->name('getDepartments');

    // Route::get('commission/{commission}/stat', [CommissionController::class, 'stat'])->name('dashboard.commission.stat');
    // Route::get('commission/{id}/students', [CommissionController::class, 'getStudentsInCommission'])->name('dashboard.commission.students');



    Route::resource('attendence', AttendenceController::class);



    // Route::resource('projet', ProjetController::class);


    // Route::get('projects/edit-all-dates', [ProjetController::class, 'editAllDatesForm'])->name('projects.edit_all_dates');
    Route::post('projects/update-all-dates', [ProjetController::class, 'updateAllDates'])->name('projects.update_all_dates');

    Route::get('reports', [ProjetController::class, 'studentReports'])->name('student.reports');

    Route::get('print/project-report', [ProjetController::class, 'printStudentReport'])->name('dashboard.print.studentReport');

    // Route::get('projects/{project}/add-commission', [ProjetController::class, 'addCommissionForm'])->name('projects.add_commission');

    Route::post('projects/{project}/add-commission', [ProjetController::class, 'storeCommission'])->name('projects.store_commission');

    Route::post('update_project_status', [ProjetController::class, 'updateProjectStatus'])->name('update_project_status');

    // Route::get('project/{id}/add-type', [ProjetController::class, 'addProjectType'])->name('dashboard.projects.add_type');
    Route::post('project/{id}/add-type', [ProjetController::class, 'storeProjectType'])->name('projects.store_type');
    // Route::get('project/{id}/edit-type', [ProjetController::class, 'editProjectType'])->name('dashboard.projects.edit_type');
    Route::put('project/{id}/edit-type', [ProjetController::class, 'updateProjectType'])->name('projects.update_type');

    
    // Route::get('project/{id}/add-classification', [ProjetController::class, 'addProjectClassification'])->name('dashboard.projects.add_classification');
    Route::post('project/{id}/add-classification', [ProjetController::class, 'storeProjectClassification'])->name('projects.store_classification');
    // Route::get('project/{id}/edit-classification', [ProjetController::class, 'editProjectClassification'])->name('dashboard.projects.edit_classification');
    Route::put('project/{id}/edit-classification', [ProjetController::class, 'updateProjectClassification'])->name('projects.update_classification');


    Route::get('project/{id}/add-project-tracking', [ProjetController::class, 'addProjectTracking'])->name('dashboard.projects.add_tracking');
    // Route::post('project/{id}/add-project-tracking', [ProjetController::class, 'storeProjectTracking'])->name('projects.store_tracking');
    // Route::get('project/{id}/edit-project-tracking', [ProjetController::class, 'editProjectTracking'])->name('dashboard.projects.edit_tracking');
    Route::put('project/{id}/edit-project-tracking', [ProjetController::class, 'updateProjectTracking'])->name('projects.update_tracking');
    
    // Route::get('project/{id}/edit-status-project-tracking', [ProjetController::class, 'editStatusProjectTracking'])->name('dashboard.projects.edit_status_tracking');
    Route::put('project/{id}/edit-status-project-tracking', [ProjetController::class, 'updateStatusProjectTracking'])->name('projects.update_status_tracking');


    Route::get('administrative/{id}', [ProjetController::class, 'administartiveShow'])->name('dashboard.projects.administrative_tracking');
    Route::post('update_selected_projects_status', [ProjetController::class, 'updateSelectedStatus'])->name('dashboard.update_selected_projects_status');

    // Route::get('students/print/{id}', [CertificateController::class, 'printStudent'])->name('dashboard.certificate.print');
    Route::resource('subjects', SubjectController::class);
    Route::resource('evaluations', EvaluationController::class);
    // Route::get('evaluations/create/{id}', [EvaluationController::class, 'create'])->name('evaluations.create');
    Route::prefix('print')->name('print.')->group(function () {
        Route::get('students', [PrintController::class, 'students'])->name('students');
        Route::get('teachers', [PrintController::class, 'teachers'])->name('teachers');
        Route::get('commission/{id}', [PrintController::class, 'printCommission'])->name('commission');
        Route::get('attendence', [PrintController::class, 'attendence'])->name('attendence');
        Route::get('review', [PrintController::class, 'review'])->name('review');
        Route::get('certificate', [PrintController::class, 'certificate'])->name('certificate');
        Route::get('trainee_notebook/{student_id}', [PrintController::class, 'trainee_notebook'])->name('trainee_notebook');
        Route::get('supervisors/{student_id}', [PrintController::class, 'printSupervisors'])->name('supervisors');
        Route::get('statistics/membres' , [StatisticsController::class, 'printMembre'])->name('dashboard.statistics.prinrt_statistic_membre');
        Route::get('statistics/projects' , [StatisticsController::class, 'printProjectStatistic'])->name('dashboard.statistics.prinrt_statistice_project');
        Route::get('statistics/mini-project', [StatisticsController::class, 'printMiniProject'])->name('dashboard.statistics.print_statistic_mini_project');
        Route::get('statistics/startup-project', [StatisticsController::class, 'printStartupProject'])->name('dashboard.statistics.print_statistic_startup_project');
        Route::get('statistics/paten-project', [StatisticsController::class, 'printPatentProject'])->name('dashboard.statistics.print_statistic_patent_project');
        Route::get('statistics/project-classification', [StatisticsController::class, 'printStatisticProject'])->name('dashboard.statistics.print_statistic_project_classification');
        Route::get('statistics/mini-project-stage', [StatisticsController::class, 'printMiniProjectStages'])->name('dashboard.statistics.print_statistic_mini_project_stage');
        Route::get('statistics/startup-project-stage', [StatisticsController::class, 'printStartupProjectStages'])->name('dashboard.statistics.print_statistic_startup_project_stage');
        Route::get('statistics/patent-project-stage', [StatisticsController::class, 'printPatentProjectStages'])->name('dashboard.statistics.print_statistic_patent_project_stage');
        Route::get('statistics/patent-startup-project-stage', [StatisticsController::class, 'printPatentStartupProjectStages'])->name('dashboard.statistics.print_statistic_patent_startup_project_stage');
    });
    // Route::resource('certificates', CertificateController::class);
});




Route::post('/update-status', [ProjetController::class, 'updateStatus'])->name('update-status');


/* ----------------------- End Dashboard -----------------------*/






Route::get('/', function () {
    return redirect()->route('dashboard.index');
    // return view('front.home.index');
});

Route::get('/about', function(){
  return redirect()->route('dashboard.index');
    // return view('front.home.about');
});
Route::get('/service', function(){
  return redirect()->route('dashboard.index');
    // return view('front.home.service');
});





Route::get('/ddd', function () {
  // Clear cache
  Artisan::call('cache:clear');
  // Clear configuration cache
  Artisan::call('config:cache');
  // Clear routes
  Artisan::call('route:clear');
  // Cache routes
  Artisan::call('route:cache');
  // Cache views
  Artisan::call('view:cache');
  // Clear views
  Artisan::call('view:clear');

  return 'Success';
});
