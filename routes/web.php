<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\Commission\CommissionController;
use App\Http\Controllers\Student\AccountController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Note\NoteController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Print\PrintController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Dashboard\Setting\SettingController;
use App\Http\Controllers\Dashboard\Student\StudentController;
use App\Http\Controllers\Dashboard\Subject\SubjectController;
use App\Http\Controllers\Dashboard\Teacher\TeacherController;
use App\Http\Controllers\Dashboard\Attendence\AttendenceController;
use App\Http\Controllers\Dashboard\Evaluation\EvaluationController;
use App\Http\Controllers\Dashboard\Certificate\CertificateController;
use App\Http\Controllers\Dashboard\ExcelImport\ExcelImportController;
use App\Http\Controllers\Dashboard\Project\ProjetController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Supervisor\SupervisingTeacherController;
use App\Http\Controllers\Teacher\TeacherDashboardController;

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
define('PAGINATE_COUNT',100);
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
    Route::get('register', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
    Route::post('login', [LoginController::class, 'submitLogin'])->name('login');
});

Route::get('logout', LogoutController::class)->middleware('auth:admin,student,teacher')
    ->name('auth.logout');
/* ----------------------- End Authentication -----------------------*/


/* ----------------------- Start Dashboard -----------------------*/

// $adminRoute = env('ADMIN_ROUTE');
// $adminRoute = 'admins';


// Route::get('logout', LogoutController::class)->middleware('auth:admin,student,teacher')
//     ->name('auth.logout');

Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin,teacher')->group(function () {
    Route::resource('/', DashboardController::class);
    Route::post('/analyse/added', [DashboardController::class, 'analyseGetStudentByYear']);
    Route::post('/analyse/gender', [DashboardController::class, 'analyseGetStudentByGender']);
    Route::post('/analyse/point', [DashboardController::class, 'analyseGetStudentByPoint']);
    Route::resource('admins', AdminController::class);
    Route::resource('students', StudentController::class);
    Route::post('import-student-excel', [ExcelImportController::class, 'import'])->name('student.import.excel');
    Route::get('students/{student}/profile', [StudentController::class, 'showProfile'])->name('dashboard.students.profile');
    Route::get('students/{id}/edit-stage', [StudentController::class, 'editStage'])->name('dashboard.students.editStage');
    Route::post('students/{id}/updateStage', [StudentController::class, 'updateStage'])->name('dashboard.students.updateStage');
    Route::resource('teachers', TeacherController::class);
    Route::resource('commission', CommissionController::class);
    Route::get('commission/{commission}/edit', [CommissionController::class, 'edit'])->name('dashboard.commission.edit');
    Route::put('commission/{commission}', [CommissionController::class, 'update'])->name('dashboard.commission.update');
    Route::delete('commission/{commission}', [CommissionController::class, 'destroy'])->name('dashboard.commission.destroy');
    Route::resource('attendence', AttendenceController::class);
    Route::resource('projet', ProjetController::class);
    Route::get('projects/edit-all-dates', [ProjetController::class, 'editAllDatesForm'])->name('projects.edit_all_dates');
    Route::post('projects/update-all-dates', [ProjetController::class, 'updateAllDates'])->name('projects.update_all_dates');
    Route::get('reports', [ProjetController::class, 'studentReports'])->name('student.reports');
    Route::get('print/project-report', [ProjetController::class, 'printStudentReport'])->name('dashboard.print.studentReport');
    Route::get('project/{project}', [ProjetController::class, 'show'])->name('dashboard.project.show');
    Route::get('projects/{project}/add-commission', [ProjetController::class, 'addCommissionForm'])->name('projects.add_commission');
    Route::post('projects/{project}/add-commission', [ProjetController::class, 'storeCommission'])->name('projects.store_commission');
    Route::post('update_project_status', [ProjetController::class, 'updateProjectStatus'])->name('update_project_status'); 
    Route::get('project/{id}/add-type', [ProjetController::class, 'addProjectType'])->name('dashboard.projects.add_type');
    Route::post('project/{id}/add-type', [ProjetController::class, 'storeProjectType'])->name('dashboard.projects.store_type');

    Route::get('project/{id}/edit-type', [ProjetController::class, 'editProjectType'])->name('dashboard.projects.edit_type');
    Route::put('project/{id}/edit-type', [ProjetController::class, 'updateProjectType'])->name('dashboard.projects.update_type');
    
    Route::get('project/{id}/add-classification', [ProjetController::class, 'addProjectClassification'])->name('dashboard.projects.add_classification');
    Route::post('project/{id}/add-classification', [ProjetController::class, 'storeProjectClassification'])->name('dashboard.projects.store_classification');

    Route::get('project/{id}/edit-classification', [ProjetController::class, 'editProjectClassification'])->name('dashboard.projects.edit_classification');
    Route::put('project/{id}/edit-classification', [ProjetController::class, 'updateProjectClassification'])->name('dashboard.projects.update_classification');

    Route::get('project/{id}/add-project-tracking', [ProjetController::class, 'addProjectTracking'])->name('dashboard.projects.add_tracking');
    Route::post('project/{id}/add-project-tracking', [ProjetController::class, 'storeProjectTracking'])->name('dashboard.projects.store_tracking');
    
    Route::get('project/{id}/edit-project-tracking', [ProjetController::class, 'editProjectTracking'])->name('dashboard.projects.edit_tracking');
    Route::put('project/{id}/edit-project-tracking', [ProjetController::class, 'updateProjectTracking'])->name('dashboard.projects.update_tracking');
    
    Route::get('project/{id}/edit-status-project-tracking', [ProjetController::class, 'editStatusProjectTracking'])->name('dashboard.projects.edit_status_tracking');
    Route::put('project/{id}/edit-status-project-tracking', [ProjetController::class, 'updateStatusProjectTracking'])->name('dashboard.projects.update_status_tracking');
    
    

    Route::resource('subjects', SubjectController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::get('evaluations/create/{id}', [EvaluationController::class, 'create'])->name('evaluations.create');
    Route::prefix('print')->name('print.')->group(function () {
        Route::get('students', [PrintController::class, 'students'])->name('students');
        Route::get('teachers', [PrintController::class, 'teachers'])->name('teachers');
        Route::get('attendence', [PrintController::class, 'attendence'])->name('attendence');
        Route::get('review', [PrintController::class, 'review'])->name('review');
        Route::get('certificate', [PrintController::class, 'certificate'])->name('certificate');
        Route::get('trainee_notebook/{student_id}', [PrintController::class, 'trainee_notebook'])->name('trainee_notebook');
        Route::get('supervisors/{student_id}', [PrintController::class, 'printSupervisors'])->name('supervisors');
        Route::get('certificate/{id}/label',[PrintController::class, 'label'])->name('label');
    });
    Route::resource('certificates', CertificateController::class);
    Route::resource('settings', SettingController::class)->middleware('auth:admin');
});



Route::name('student.')->middleware('auth:student')->group(function () {
    Route::get('student', [StudentDashboardController::class, 'index'])->name('index');
    Route::get('student/{student_id}', [StudentDashboardController::class, 'indexAdmin'])->name('index.admin');
    Route::resource('account', AccountController::class);
    Route::resource('project', ProjectController::class);
    // Route::get('project/{id}/addBmc', [ProjectController::class, 'addBmcFile'])->name('student-project.addBmc');

    Route::resource('supervisor', SupervisingTeacherController::class);
    Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
    Route::delete('account/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
    Route::put('account/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::post('supervisor/assign/{id}', [SupervisingTeacherController::class, 'assign'])->name('supervisor.assign');
    
    Route::get('student/certificates/{id}', [StudentController::class, 'certificates'])->name('certificates');
    // Route::prefix('print')->name('print.')->group(function () {

    // });
});
Route::get('print/certificate/{project_id}', [PrintController::class, 'generateCertificate'])->name('print.certificate');
Route::get('print/certificate/{project_id}/{student_id?}', [PrintController::class, 'generateStudentCertificate'])->name('print.certificate');

Route::get('student/project/{id}/addBmc', [ProjectController::class, 'addBmcFile'])->name('student.project.addBmc');
Route::post('student/project/{id}/storeBmc', [ProjectController::class, 'storeBmcFile'])->name('student.project.storeBmcFile');

Route::get('student/project/{id}/reformatBmc', [ProjectController::class, 'reformatBmcFile'])->name('student.project.reformatBmc');
Route::post('student/project/{id}/reformatBmc', [ProjectController::class, 'updateBmcFile'])->name('student.project.updateBmc');




Route::name('teacher.')->middleware('auth:teacher')->group(function () {
    Route::resource('students', TeacherDashboardController::class);
    Route::get('projects', [TeacherDashboardController::class, 'projects'])->name('project.projects');
    Route::get('projects/{project}', [TeacherDashboardController::class, 'showProject'])->name('project.show');
    Route::post('/update_project_status', [TeacherDashboardController::class, 'updateProjectStatus'])->name('update_project_status');
 
});


Route::prefix('download')->middleware('auth:admin,student')->controller(PrintController::class)->name('download.')->group(function () {
    Route::get('reviews/{student_id}', 'review')->name('review');
    Route::get('certificate/{student_id}', 'certificate')->name('certificate');
    Route::get('student/modal', 'studentModel')->middleware('auth:admin')->name('studentModel');


    // CertificateController
    // certificates
});
/* ----------------------- End Dashboard -----------------------*/


Route::get('/', function () {
    return view('front.home.index');
});

Route::get('/about', function(){
    return view('front.home.about');
});
Route::get('/service', function(){
    return view('front.home.service');
});