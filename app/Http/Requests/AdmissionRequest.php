<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'suffix' => 'nullable|string|max:10',
            'age' => 'required|integer|min:1|max:120',
            'sex' => 'required|in:Male,Female',
            'number' => 'required|regex:/^(\+63|0)\d{10}$/',
            'religion' => 'required|string|max:50',
            'sports' => 'required|string|max:50',
            'residency_status' => 'required|in:Pasig Resident,Non-Pasig Resident',
            'district' => 'required_if:residency_status,Pasig Resident|nullable|string|max:20',
            'barangay1' => 'required_if:district,district1|nullable|string|max:50',
            'barangay2' => 'required_if:district,district2|nullable|string|max:50',
            'non_pasig_resident' => 'required_if:residency_status,Non-Pasig Resident|nullable|string|max:100',
            'address' => 'required|string|max:100',
            'type' => 'required|in:public,private',
            'public_school' => 'required_if:type,public|nullable|string|max:100',
            'other_public_school' => 'required_if:public_school,Other|nullable|string|max:100',
            'private_school' => 'required_if:type,private|nullable|string|max:100',
            'email' => 'required|email|max:50|unique:users,email',
            'talents' => 'required|string|max:50',
            'strand' => 'required|string',
            'monthly_salary' => 'required|string|in:Low-income,Lower-middle-income,Middle-income,Upper-middle-income,High-income group',
            'relation' => 'required|in:parent,guardian',
            'guardian_last_name' => 'required_if:relation,guardian|string|max:50',
            'guardian_first_name' => 'required_if:relation,guardian|string|max:50',
            'guardian_middle_name' => 'required_if:relation,guardian|string|max:50',
            'guardian_suffix' => 'nullable|string|max:10',
            'guardian_dob' => 'required_if:relation,guardian|integer|min:1|max:120',
            'guardian_phone_number' => 'required_if:relation,guardian|regex:/^(\+63|0)\d{10}$/',
            'guardian_email' => 'required_if:relation,guardian|email|max:50',
            'guardian_address' => 'required_if:relation,guardian|string|max:100',
            'parent_last_name' => 'required_if:relation,parent|string|max:50',
            'parent_first_name' => 'required_if:relation,parent|string|max:50',
            'parent_middle_name' => 'required_if:relation,parent|string|max:50',
            'parent_suffix' => 'nullable|string|max:10',
            'parent_dob' => 'required_if:relation,parent|integer|min:1|max:120',
            'parent_phone_number' => 'required_if:relation,parent|regex:/^(\+63|0)\d{10}$/',
            'parent_email' => 'required_if:relation,parent|email|max:50',
            'parent_address' => 'required_if:relation,parent|string|max:100',
        ];
    }
}
