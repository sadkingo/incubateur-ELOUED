<?php

namespace App\Imports;

use App\Models\Coupon;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use function PHPUnit\Framework\isNull;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $facultyId;

    public function __construct($facultyId)
    {
        $this->facultyId = $facultyId;
    }


    public function model(array $row) {

      $rkm_altsgyl = Student::where('registration_number', $row['rkm_altsgyl'])->first();
      $rkm_alhatf = Student::where('phone', $row['rkm_alhatf'])->first();

      $faculty = Faculty::find($this->facultyId);

      $birthday = isset($row['tarykh_almylad'])
      ? Date::excelToDateTimeObject($row['tarykh_almylad'])->format('Y-m-d')
      : null;

      $gender = isset($row['algns']) ? ($row['algns'] == 'ذكر' ? 1 : 0) : null;

      if ($rkm_altsgyl || $rkm_alhatf || !$faculty || empty($row['rkm_altsgyl']) || !isset($row['rkm_altsgyl'])) {
        return null;
      }

      Log::info($row);


      return new Student([
        'registration_number' => $row['rkm_altsgyl'],
        'firstname_ar'        => $row['alasm_balaarby'] ?? null,
        'lastname_ar'         => $row['allkb_balaarby'] ?? null,
        'firstname_fr'        => $row['alasm_balfrnsy'] ?? null,
        'lastname_fr'         => $row['allkb_balfrnsy'] ?? null,
        'birthday'            => $birthday,
        'gender'              => $gender,
        'state_of_birth'      => $row['olay_almylad'] ?? null,
        'place_of_birth'      => $row['mkan_almylad'] ?? null,
        'residence'           => $row['alakam'] ?? null,
        'batch'               => $row['aldfaa'] ?? null,
        'academicLevel'       => $row['almsto_aldrasy_lysansmastrdktorah'] ?? null,
        'specialty'           => $row['tkhss'] ?? null,
        'id_faculty'          => $this->facultyId,
        'department'          => $row['alksm'] ?? null,
        'email'               => $row['albryd_alalktrony'] ?? null,
        'phone'               => $row['rkm_alhatf'] ?? null,
        'password'            => Hash::make('default_password'),
    ]);
    }
}
