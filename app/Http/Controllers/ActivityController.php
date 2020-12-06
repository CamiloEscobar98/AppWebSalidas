<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function register(\App\Http\Requests\Activity\ActivityRequest $request)
    {
        $validated = $request->validated();
        $activity = $this->insert($validated);
        if ($activity) {
            return back()->with('register_complete', 'Se ha registrado correctamente la actividad ' . $activity->title);
        }
        return back()->with('register_failed', 'No se ha podido registrar correctamente');
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $activity = \App\Models\Activity::find($request->activity_id);
            $aux = $activity;
            if ($activity->delete()) {
                return 'Se ha eliminado correctamente la actividad ' . $aux->title;
            }
        }
    }

    public function update(\App\Http\Requests\Activity\ActivityRequestUpdate $request)
    {
        $validated = $request->validated();
        $activity = $this->updateActivity($validated);
        if ($activity) {
            return back()->with('update_complete', 'Se ha actualizado correctamente la actividad.');
        }
        return back()->with('update_failed', 'No se ha podido actualizar correctamente');
    }

    private function insert($validated)
    {
        $activity = \App\Models\Activity::create([
            'title' => strtolower($validated['title']),
            'subtitle' => strtolower($validated['subtitle']),
            'description' => $validated['description'],
            'place' => $validated['place'],
            'teacher_id' => \App\User::where('emailu', $validated['teacher'])->first()->id,
            'date' => $validated['date']
        ]);
        return $activity;
    }

    private function updateActivity($validated)
    {
        $activity = \App\Models\Activity::find($validated['activity']);
        $activity->update($validated);
        $activity->teacher_id = \App\User::where('emailu', $validated['teacher'])->first()->id;
        $activity->save();
        return $activity;
    }
}
