<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Developer'){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'campus_name' => 'required|string|max:50',
            'tagline' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:60',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:50',
            'logo' => 'nullable',
            'voucher_logo' => 'nullable',
            'established_in_date' => 'nullable|date',
            'fee_submission_last_day' => 'required|integer',
        ];
    }
}
