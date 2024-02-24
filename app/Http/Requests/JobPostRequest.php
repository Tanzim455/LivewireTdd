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
            'min_salary'=>'required|integer',
            'max_salary'=>'required|integer',
             'min_experience'=>'required|integer',
             'max_experience'=>'required|integer',
             'expiration_date'=>'required|date|after_or_equal:today',
             'apply_url'=>'required|url',
             'job_location'=>'required',
             'job_location_type'=>'required|in:remote,onsite,hybrid'
        ];
    }
}
