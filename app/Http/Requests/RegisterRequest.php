<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        if ($this->type == 'personal') {
//            return [
//                'type' => ['required', Rule::in(['company', 'personal'])],
//                'id_check' => ['required', Rule::in(['yes'])],
//                'password_check' => ['required', Rule::in(['yes'])],
//                'user_id' => ['required', 'string',  'max:255', 'unique:users'],
//                'name' => ['required', 'string', 'max:255'],
//                'email' => ['required', 'string', 'email', 'max:255'],
//                'phone' => ['required', 'string', 'regex:/^\d{3}-\d{3,4}-\d{4}$/'],
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
//            ];
//        }
//        else if ($this->type == 'company') {
//            return [
//                'type' => ['required', Rule::in(['company', 'personal'])],
//                'id_check' => ['required', Rule::in(['yes'])],
//                'password_check' => ['required', Rule::in(['yes'])],
//                'user_id' => ['required', 'string',  'max:255', 'unique:users'],
//                'name' => ['required', 'string', 'max:255'],
//                'email' => ['required', 'string', 'email', 'max:255'],
//                'phone' => ['required', 'string', 'regex:/^\d{3}-\d{3,4}-\d{4}$/'],
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
//                'company_name' => ['required', 'string', 'max:255'],
//                'tax_name' => ['required', 'string', 'max:255'],
//                'tax_company_name' => ['required', 'string', 'max:255'],
//                'tax_industry' => ['required', 'string', 'max:255'],
//                'tax_img' => ['required', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
//                'tax_zipcode' => ['required', 'string', 'max:255'],
//                'tax_addres_1' => ['required', 'string', 'max:255'],
//                'tax_addres_2' => ['required', 'string', 'max:255'],
//            ];
//        }
    }

    public function validationData()
    {
//        return array_merge($this->all(), [
//            'email' => $this->email_id.'@'.$this->email_text,
//            'phone' => $this->phone_1.'-'.$this->phone_2.'-'.$this->phone_3,
//        ]);
    }

}
