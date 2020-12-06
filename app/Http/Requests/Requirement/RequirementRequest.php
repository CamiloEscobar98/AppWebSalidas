<?php

namespace App\Http\Requests\Requirement;

use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('role') == 'administrador';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'activity' => ['required', 'exists:activities,id'],
            'requirement' => ['required', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'activity' => 'actividad',
            'requirement' => 'requerimiento'
        ];
    }
}
