<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:191'],
            'teacher' => ['required', 'exists:users,emailu'],
            'subtitle' => ['required', 'string', 'max:191', 'unique:activities,title'],
            'description' => ['required', 'string'],
            'place' => ['required', 'string'],
            'date' => ['required', 'date']
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titulo de la actividad',
            'subtitle' => 'subtitulo de la actividad',
            'place' => 'ubicación de la actividad',
            'description' => 'descripción de la actividad',
            'date' => 'fecha de la actividad',
            'teacher' => 'docente'
        ];
    }
}
