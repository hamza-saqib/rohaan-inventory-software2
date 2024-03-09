<?php

namespace App\Imports;

use App\Models\AcademicYear;
use App\Models\Clas;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentRegistration;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $class = Clas::where('name', $row['class'])->get()->first();
            $section = Section::where('name', $row['section'])->where('class_id', $class->id)->get()->first();
            $academicYear = AcademicYear::where('title', $row['academic_year'])->get()->first();

            $student = Student::create([
                'name' => $row['name'],
                'father_name' => $row['father_name'],
                'gender' => $row['gender'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'father_gaurdian_phone_1' => $row['father_phone_1'],
                'father_gaurdian_phone_2' => $row['father_phone_2'],
                'address' => $row['address'],
                'date_of_birth' => date('Y-m-d', $row['date_of_birth']),
                'date_of_joining' => date('Y-m-d', $row['date_of_joining']),
                'national_identity_no' => $row['national_identity_no'],
                'fees' => $row['fees'],
                'arears' => $row['arears'],
                'class_id' => is_null($class)? null : $class->id,
                'section_id' => is_null($section)? null : $section->id,
                'academic_year_id' => is_null($academicYear)? null : $academicYear->id,
            ]);

            if($student){
                $year = Carbon::parse($academicYear->start_date)->format('y');
                $studentCount =  StudentRegistration::where('registration_no', 'like', $year.'%')->count();
                $registrationNo = sprintf("%02d", $year) . sprintf("%02d", $class->id) . sprintf("%04d", ($studentCount > 0)? $studentCount : 1);

                StudentRegistration::create([
                    'registration_no' => $registrationNo,
                    'academic_year_id' => $academicYear->id,
                    'student_id'=> $student->id,
                    'class_id'=>  is_null($class)? null : $class->id,
                    'section_id'=> is_null($section)? null : $section->id,
                    // 'date_of_registration'=> $request->input('date_of_registration'),
                    'fees'=> $row['fees'],
                ]);
                $student->registration_no = $registrationNo;
                $student->save();
            }
        }

    }

    public function rules(): array
    {
        return[
            'name' => 'required|string|max:50',
            'father_name' => 'required|string|max:50',
            'profile_image' => 'nullable',
            'gender' => 'required|string|in:male,female,other,Male,Female,Other',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|max:20',
            'father_phone_1' => 'required|max:20',
            'father_phone_2' => 'nullable|max:20',
            'address' => 'nullable|string|max:100',
            'date_of_birth' => 'required',
            'date_of_joining' => 'nullable',
            'national_identity_no' => 'nullable|max:30',
            'father_national_identity_no' => 'nullable|max:30',
            'fees' => 'required|numeric',
            'academic_year' => 'required',
        ];
    }
}
