<?php

namespace App\Imports;

use App\Models\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TeachersImport implements ToCollection, WithHeadingRow, WithValidation
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
            $teacher = Teacher::create([
                'name' => $row['name'],
                'designation' => $row['designation'],
                'gender' => $row['gender'],
                'email' => $row['email'],
                'whatsapp' => $row['whatsapp'],
                'phone_1' => $row['phone_1'],
                'address' => $row['address'],
                'date_of_birth' => date('Y-m-d', $row['date_of_birth']),
                'date_of_joining' => date('Y-m-d', $row['date_of_joining']),
                'salary' => $row['salary'],
                'major_subject' => $row['major_subject'],
                'qualification' => $row['qualification'],
            ]);

        }

    }

    public function rules(): array
    {
        return[
            'name' => 'required|string|max:50',
            'designation' => 'nullable|string|max:50',
            'gender' => 'required|string|in:male,female,other',
            'email' => 'nullable|email|max:50',
            'phone_1' => 'required|max:20',
            'phone_2' => 'nullable|max:20',
            'address' => 'nullable|max:100',
            'date_of_birth' => 'nullable',
            'date_of_joining' => 'required',
            'major_subject' => 'nullable|max:50',
            'qualification' => 'nullable|max:50',
            'salary' => 'required|numeric',
        ];
    }

}
