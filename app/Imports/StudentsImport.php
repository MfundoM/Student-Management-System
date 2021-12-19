<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class StudentsImport implements ToModel, WithCustomCsvSettings, WithHeadingRow, WithValidation,  SkipsOnError, SkipsOnFailure
{
    use Importable,SkipsErrors, SkipsFailures;

    private $rows = 0;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
        return new Student([
            'student_number'        => $row['student_number'],
            'firstname'             => $row['firstname'],
            'surname'               => $row['surname'],
            'course_code'           => $row['course_code'],
            'course_description'    => $row['course_description'],
            'grade'                 => $row['grade'],
        ]);
    }

    /*
     * Change the default delimiter from ',' to ';'.
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'student_number' => \Illuminate\Validation\Rule::unique('students', 'student_number'),
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'student_number.unique' => 'Please note student numbers must be unique, duplicates are not allowed.',
        ];
    }

    /**
     * @return integer
     */
    public function getRowCount()
    {
        return $this->rows;
    }
}
