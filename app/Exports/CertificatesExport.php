<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CertificatesExport implements FromArray, WithHeadings {

    protected $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function array(): array {
        return $this->data;
    }

    public function headings(): array {
        return [
            'ID',
            'File Name',
            'Project Name',
            'Student Name',
        ];
    }
}
