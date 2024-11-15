<?php

namespace App\Http\Controllers\Dashboard\Certificate;

use App\Exports\CertificatesExport;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Project;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Repositories\Certificate\CertificateRepository;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CertificateController extends Controller
{
    private $students;
    private $sertificates;

    /**
     * StudentController constructor.
     * @param StudentRepository $students
     * @param CertificateRepository $sertificates
     */

    public function __construct(StudentRepository $students,CertificateRepository $sertificates)
    {
        $this->students = $students;
        $this->sertificates = $sertificates;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $studentsQuery = Student::query()
    //         ->with(['projects', 'studentGroups', 'certificates'])
    //         ->when($request->project_classification, function ($query) use ($request) {
    //             return $query->whereHas('projects', function ($query) use ($request) {
    //                 $query->where('project_classification', $request->project_classification);
    //             });
    //         });

    //     $students = $studentsQuery->paginate(
    //         $request->perPage ? $request->perPage : 100,
    //         ['*'],
    //         'page',
    //         $request->page ? $request->page : 1
    //     );

    //     $listStduents = $this->students->listStudentHasNotCertificate();

    //     return view('dashboard.certificate.index', compact('students', 'listStduents'));
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request->certificate);
        $fileName = time().'.'.$request->certificate->extension();

        // dd( $fileName);
        // $request->certificate->move(storage_path('uploads/sertificates'), $fileName);
        // $request->file->move(public_path('uploads'), $fileName);

        // Storage::put("uploads/sertificates/",  $fileName);
        // Storage::append('uploads/sertificates/file.log', 'Appended Text');


        // Storage::put("uploads/sertificates", $fileName);
        // dd($request->all());

        // Storage::disk('uploads')->put($fileName, 'uploads/sertificates/');
        Storage::disk('uploads')->put($fileName,'uploads');
        // $request->certificate->move(storage_path('uploads/sertificates/'), $fileName);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function printStudent($id){
    //     $certificate = Certificate::find($id);
    //     $project = Project::find($certificate->project_id)->first();
    //     $group = StudentGroup::where('project_id', $project->id)->get();

    //     return view('dashboard.certificate.print')
    //     ->with('certificate', $certificate)
    //     ->with('group', $group)
    //     ->with('project', $project);
    // }

    public function generateCertificate($id_student) {

        $student = Student::find($id_student);

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        $project = Project::where('id_student', $student->id)->first();

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        if ($project->project_classification == 1 || $project->project_classification == 2) {
            $stages = [
                1 => 'Étape de configuration',
                2 => 'Créer BMC',
                3 => 'L\'étape de préparation du prototype',
                4 => 'Étape de discussion',
                5 => 'Projet innovant label',
            ];
        } elseif ($project->project_classification == 3) {
            $stages = [
                1 => 'L\'étape de préparation du prototype',
                2 => 'Rédiger un modèle descriptif',
                3 => 'Étape de l\'enregistrement d\'une demande de brevet',
                4 => 'Obtenir un certificat d\’enregistrement pour la demande de dépôt de brevet',
                5 => 'Recevoir les réserves et modifications demandées à l\’INAPI',
                6 => 'Renvoyer le formulaire modifié après levée des réserves',
                7 => 'Obtenu un brevet',
            ];
        } elseif ($project->project_classification == 4) {
            $stages = [
                1 => 'Étape de configuration',
                2 => 'Créer BMC',
                3 => 'L\'étape de préparation du prototype',
                4 => 'Rédiger un modèle descriptif',
                5 => 'Étape de l\'enregistrement d\'une demande de brevet',
                6 => 'Obtenir un certificat d\’enregistrement pour la demande de dépôt de brevet',
                7 => 'Recevoir les réserves et modifications demandées à l\’INAPI',
                8 => 'Renvoyer le formulaire modifié après levée des réserves',
                9 => 'Étape de discussion',
                10 => 'Obtention d\'un brevet pour une startup',
            ];
        } else {
            $stages = [
                1 => 'Unknown Stage',
            ];
        }

        $currentStage = $stages[$project->project_tracking] ?? 'Unknown Stage';

        return view('student-dashboard.certificate', compact('student', 'project', 'currentStage'));
    }

    public function generateStudentCertificate($cid,$sid) {

        $certificate = Certificate::find($cid);
        if (!$certificate) {
            return redirect()->back()->with('error', 'Certificate not found');
        }

        $project = $certificate->project;
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found for this certificate');
        }

        $student = $project->students->where('id', $sid)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found for this project');
        }


        if ($project->project_classification == 1 || $project->project_classification == 2) {
            $stages = [
                1 => 'Étape de configuration',
                2 => 'Créer BMC',
                3 => 'L\'étape de préparation du prototype',
                4 => 'Étape de discussion',
                5 => 'Projet innovant label',
            ];
        } elseif ($project->project_classification == 3) {
            $stages = [
                1 => 'L\'étape de préparation du prototype',
                2 => 'Rédiger un modèle descriptif',
                3 => 'Étape de l\'enregistrement d\'une demande de brevet',
                4 => 'Obtenir un certificat d\’enregistrement pour la demande de dépôt de brevet',
                5 => 'Recevoir les réserves et modifications demandées à l\’INAPI',
                6 => 'Renvoyer le formulaire modifié après levée des réserves',
                7 => 'Obtenu un brevet',
            ];
        } elseif ($project->project_classification == 4) {
            $stages = [
                1 => 'Étape de configuration',
                2 => 'Créer BMC',
                3 => 'L\'étape de préparation du prototype',
                4 => 'Rédiger un modèle descriptif',
                5 => 'Étape de l\'enregistrement d\'une demande de brevet',
                6 => 'Obtenir un certificat d\’enregistrement pour la demande de dépôt de brevet',
                7 => 'Recevoir les réserves et modifications demandées à l\’INAPI',
                8 => 'Renvoyer le formulaire modifié après levée des réserves',
                9 => 'Étape de discussion',
                10 => 'Obtention d\'un brevet pour une startup',
            ];
        } else {
            $stages = [
                1 => 'Unknown Stage',
            ];
        }

        $currentStage = $stages[$project->project_tracking] ?? 'Unknown Stage';

        return view('dashboard.certificate.certificate', compact('student','project', 'currentStage'));
    }


    public function export(Request $request) {
        $classification = $request->query('classification');
    
        $query = Certificate::with(['project.students'])->select('id', 'file_name','project_id');
    
        if (($classification !== null) && ($classification != 'all')) {
            $query->whereHas('project', function ($query) use ($classification) {
                $query->where('project_classification', $classification);
            });
        }
        $certificates = $query->get();
    
        $data = [];
        foreach ($certificates as $certificate) {
            if ($certificate->project) {
                foreach ($certificate->project->students as $student) {
                    $data[] = [
                        'ID' => $student->id,
                        'File Name' => $certificate->file_name,
                        'Project Name' => $certificate->project->name,
                        'Student Name' => $student->name,
                    ];
                }
            }
        }

        return Excel::download(new CertificatesExport($data), 'certificates.xlsx');
    }
    
}
