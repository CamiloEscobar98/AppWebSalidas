<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'unique:programs,name'],
            'code' => ['required', 'unique:programs,code'],
            'faculty_id' => ['required', 'exists:faculties,id']
        ];
        $attributes = [
            'name' => 'nombre del programa',
            'code' => 'código del programa',
            'faculty_id' => 'facultad'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $program = \App\Models\Program::create([
            'name' => mb_strtolower($validated['name']),
            'code' => mb_strtolower($validated['code']),
            'faculty_id' => $validated['faculty_id']
        ]);

        if ($program) {
            return back()->with('register_complete', 'Se ha registrado correctamente el programa: ' . $program->name);
        }
        return back()->with('register_failed', 'No se ha podido registrar correctamente');
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $program = \App\Models\Program::find($request->id);
            $aux = $program;
            if ($program->delete()) {
                return 'Se ha eliminado correctamente el programa ' . $aux->name;
            }
        }
    }

    public function update(Request $request)
    {
        $program = \App\Models\Program::find($request->id);
        $rules = [
            'name' => ['required', 'unique:programs,name,' . $program->id],
            'code' => ['required', 'unique:programs,code,' . $program->id],
            'faculty_id' => ['required', 'exists:faculties,id']
        ];
        $attributes = [
            'name' => 'nombre del programa',
            'code' => 'código del programa',
            'faculty_id' => 'facultad'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $program->name = mb_strtolower($validated['name']);
        $program->code = $validated['code'];
        $program->faculty_id = $validated['faculty_id'];
        $save = $program->save();

        if ($save) {
            return back()->with('update_complete', 'Se ha actualizado correctamente el programa: ' . $program->name);
        }
        return back()->with('update_failed', 'No se ha podido actualizar correctamente');
    }
}
