<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function register(\App\Http\Requests\Requirement\RequirementRequest $request)
    {
        $validated = $request->validated();
        $requirement = $this->insert($validated);
        if ($requirement) {
            return back()->with('register_complete', 'Se ha registrado correctamente el requerimiento.');
        }
        return back()->with('register_failed', 'No se ha podido registrar correctamente.');
    }

    private function insert($validated)
    {
        return $requirement = \App\Models\Requirement::create([
            'activity_id' => $validated['activity'],
            'text' => $validated['requirement']
        ]);
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $requirement = \App\Models\Requirement::find($request->requirement_id);
            $aux = $requirement;
            if ($requirement->delete()) {
                return 'Se ha eliminado correctamente el requerimiento.';
            }
        }
    }
}
