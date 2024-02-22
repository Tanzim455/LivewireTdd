<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title'=>'required|min:10',
            'description'=>'required|min:100',
            'min_salary'=>'required|int',
            'max_salary'=>'required|int',
             'min_experience'=>'required|int',
             'max_experience'=>'required|int',
             'expiration_date'=>'required|date',
             'apply_url'=>'required|url'
        ];
    }
}
