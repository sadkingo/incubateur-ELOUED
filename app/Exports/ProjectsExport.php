<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection, WithHeadings {

    
    protected $projects;

    public function __construct($projects) {
        $this->projects = $projects;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection() {
        return $this->projects->map(function($project) {
            return [
                'ID' => $project->id,
                'Faculty ID' => $project->faculty_id,
                'Commission ID' => $project->commission_id,
                'Code' => $project->code,
                'Password' => $project->password,
                'Name' => $project->name,
                'Description' => $project->description,
                'Type Project' => $project->type_project,
                'Project Classification' => $project->project_classification,
                'Video' => $project->video,
                'BMC Status' => $project->bmc_status,
                'BMC' => $project->bmc,
                'Administrative File' => $project->administrative_file,
                'Project Tracking' => $project->project_tracking,
                'Status Project Tracking' => $project->status_project_tracking,
                'Status' => $project->status,
                'New' => $project->new,
                'Start Date' => $project->start_date,
                'End Date' => $project->end_date,
                'Academic Year' => $project->academic_year,
                'Created At' => $project->created_at,
                'Updated At' => $project->updated_at,
                'Deleted At' => $project->deleted_at,
            ];
        });
    }

    public function headings(): array {
        return [
            'ID',
            'Faculty ID',
            'Commission ID',
            'Code',
            'Password',
            'Name',
            'Description',
            'Type Project',
            'Project Classification',
            'Video',
            'BMC Status',
            'BMC',
            'Administrative File',
            'Project Tracking',
            'Status Project Tracking',
            'Status',
            'New',
            'Start Date',
            'End Date',
            'Academic Year',
            'Created At',
            'Updated At',
            'Deleted At',
        ];
    }


}
