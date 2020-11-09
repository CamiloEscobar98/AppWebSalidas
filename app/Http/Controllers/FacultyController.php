<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'unique:faculties,name']
        ];
        $attributes = [
            'name' => 'nombre de la facultad'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $faculty = \App\Models\Faculty::create([
            'name' => mb_strtolower($validated['name'])
        ]);

        if ($faculty) {
            return back()->with('register_complete', 'Se ha registrado correctamente la facultad' . $faculty->name);
        }
        return back()->with('register_failed', 'No se ha podido registrar correctamente');
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $faculty = \App\Models\Faculty::find($request->id);
            $aux = $faculty;
            if ($faculty->delete()) {
                return 'Se ha eliminado correctamente la facultad ' . $aux->name;
            }
        }
    }

    public function update(Request $request)
    {
        $faculty = \App\Models\Faculty::find($request->id);
        $rules = [
            'name' => ['required', 'unique:faculties,name,' . $faculty->id]
        ];
        $attributes = [
            'name' => 'nombre de la facultad'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $faculty->name = mb_strtolower($validated['name']);
        $save = $faculty->save();

        if ($save) {
            return back()->with('update_complete', 'Se ha actualizado correctamente la facultad' . $faculty->name);
        }
        return back()->with('update_failed', 'No se ha podido actualizar correctamente');
    }
}
