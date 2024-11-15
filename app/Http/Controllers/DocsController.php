<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use setasign\Fpdi\Fpdi;

use PhpOffice\PhpWord\TemplateProcessor;

class DocsController extends Controller {    

    public function downloadStudentJustifyAbsence(Request $request, $studentId) 
    {
        // Fetch the student from the database
        $student = Student::findOrFail($studentId);
    
        // Create new PDF with Unicode/UTF-8 support
        $pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'amiri'
        ]);
    
        // Load the existing PDF template
        $pagecount = $pdf->SetSourceFile(public_path('assets/img/doucments/justify-absence.pdf'));
        
        // Import first page
        $tplId = $pdf->ImportPage(1);
        $pdf->UseTemplate($tplId);
    
        // Configure Arabic text
        // $pdf->SetDirectionality('rtl');
        
        // Student's full name (Arabic)
        $pdf->SetFont('amiri', '', 30);
        $pdf->SetXY(10, 89);
        $pdf->Cell(0, 10, $student->full_name_fr, 0, 0, 'C');
    
        // Faculty Name (Arabic)
        $pdf->SetFont('amiri', '', 20);
        $pdf->SetXY(10, 105);
        $pdf->Cell(0, 10, $student->faculty->name_fr, 0, 0, 'C');
    
        // Specialty
        $pdf->SetXY(10, 120);
        $pdf->Cell(0, 2, $student->specialty, 1, 0, 'C');
    
        // Switch to LTR for dates
        $pdf->SetDirectionality('ltr');
        
        // Date components
        $pdf->SetXY(118, 150);
        $pdf->Cell(20, 10, date('d'), 0, 0, 'C');
    
        $pdf->SetXY(160, 150);
        $pdf->Cell(30, 10, date('M'), 0, 0, 'C');
    
        $pdf->SetXY(200, 150);
        $pdf->Cell(20, 10, date('Y'), 0, 0, 'L');
    
        // Save PDF
        $fileName = 'Student_Justify_Absence_Report_' . $student->id . '.pdf';
        $tempFilePath = storage_path('app/public/' . $fileName);
        $pdf->Output($tempFilePath, 'F');
    
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }
    
}
