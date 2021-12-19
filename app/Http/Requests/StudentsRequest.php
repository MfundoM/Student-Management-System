<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentsRequest extends FormRequest
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
        if ($this->isMethod('put')) {
            return $this->updateRules();
        } else {
            return $this->createRules();
        }
    }

    /**
     * Rules for creating resource.
     *
     * @return array
     */
    public function createRules() : array
    {
        return [
            'student_number'        => ['required', 'integer', 'min:2', Rule::unique('students','student_number')],
            'firstname'             => ['required', 'string', 'min:2'],
            'surname'               => ['required', 'string', 'min:2'],
            'course_code'           => ['required', 'string', 'min:2'],
            'course_description'    => ['required', 'string', 'min:2'],
            'grade'                 => ['required', 'string'],
        ];
    }

    /**
     * Rules for updating resource.
     *
     * @return array
     */
    public function updateRules() : array
    {
        return [
            'firstname'             => ['required', 'string', 'min:2'],
            'surname'               => ['required', 'string', 'min:2'],
            'course_code'           => ['required', 'string', 'min:2'],
            'course_description'    => ['required', 'string', 'min:2'],
            'grade'                 => ['required', 'string'],
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        $validated = $this->getValidatorInstance()->validate();

        return $validated;
    }
}
