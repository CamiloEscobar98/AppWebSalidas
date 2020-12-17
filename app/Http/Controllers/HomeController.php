<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $programs = \App\Models\Program::all();
        $document_types = \App\Models\Document_type::all();
        return view('home')->with('document_types', $document_types)->with('programs', $programs);
    }

    // Lists
    public function studentsList()
    {
        request()->user()->authorizeRoles(['director del Programa', 'administrador']);
        $students = \App\Models\Role::find(2)->users()->orderBy('name', 'ASC')->paginate(8);
        $programs = \App\Models\Program::orderBy('faculty_id', 'ASC')->get();
        $dtypes = \App\Models\Document_type::all();
        // return $students;
        return view('auth.lists.students')->with('students', $students)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function teachersList()
    {
        request()->user()->authorizeRoles(['director del Programa', 'administrador']);
        $teachers = \App\Models\Role::find(3)->users()->orderBy('name', 'ASC')->paginate(8);
        $programs = \App\Models\Program::orderBy('faculty_id', 'ASC')->get();
        $dtypes = \App\Models\Document_type::all();
        // return $teachers;
        return view('auth.lists.teachers')->with('teachers', $teachers)->with('programs', $programs)->with('document_types', $dtypes);
    }
    public function directorsList()
    {
        request()->user()->authorizeRoles(['director', 'administrador']);
        $directors = \App\Models\Role::find(4)->users()->orderBy('name', 'ASC')->paginate(8);
        $programs = \App\Models\Program::orderBy('faculty_id', 'ASC')->get();
        $dtypes = \App\Models\Document_type::all();
        // return $directors;
        return view('auth.lists.directors')->with('directors', $directors)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function facultiesList()
    {
        request()->user()->authorizeRoles(['director', 'administrador']);
        $faculties = \App\Models\Faculty::paginate(8);
        return view('auth.lists.faculties')->with('faculties', $faculties);
    }

    public function programsList()
    {
        request()->user()->authorizeRoles(['director', 'administrador']);
        $faculties = \App\Models\Faculty::all();
        $programs = \App\Models\Program::paginate(8);
        return view('auth.lists.programs')->with('programs', $programs)->with('faculties', $faculties);
    }

    public function activitiesList()
    {
        $docentes = \App\Models\Role::where('name', 'docente')->first()->users;
        $actividades = \App\Models\Activity::paginate(8);
        return view('auth.lists.activities', ['docentes' => $docentes, 'actividades' => $actividades]);
    }

    public function allactivities()
    {
        $actividades = \App\Models\Activity::paginate(8);
        return view('auth.lists.allactivities', [
            'activities' => $actividades
        ]);
    }

    // Profiles

    public function showStudent(\App\User $student)
    {
        request()->user()->authorizeRoles(['director del Programa', 'administrador']);
        $programs = \App\Models\Program::all();
        $dtypes = \App\Models\Document_type::all();
        return view('auth.profiles.student')->with('student', $student)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function showTeacher(\App\User $teacher)
    {
        request()->user()->authorizeRoles(['director del Programa', 'administrador']);
        $programs = \App\Models\Program::all();
        $dtypes = \App\Models\Document_type::all();
        return view('auth.profiles.teacher')->with('teacher', $teacher)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function showDirector(\App\User $director)
    {
        request()->user()->authorizeRoles(['director', 'administrador']);
        $programs = \App\Models\Program::all();
        $dtypes = \App\Models\Document_type::all();
        return view('auth.profiles.director')->with('director', $director)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function showFaculty(\App\Models\Faculty $faculty)
    {
        request()->user()->authorizeRoles(['director', 'administrador']);
        $programs = $faculty->programs()->paginate(5);
        return view('auth.profiles.faculty')->with('faculty', $faculty)->with('programs', $programs);
    }

    public function showProgram(\App\Models\Program $program)
    {
        request()->user()->authorizeRoles(['director', 'administrador']);
        $program = \App\Models\Program::find($program->id);
        $faculties = \App\Models\Faculty::all();
        $students = $program->studentsPaginate(5);
        $teachers = $program->teachersPaginate(5);
        return view('auth.profiles.program', [
            'program' => $program,
            'faculties' => $faculties,
            'students' => $students,
            'teachers' => $teachers
        ]);
    }

    public function showActivity(\App\Models\Activity $activity)
    {
        $docentes = \App\Models\Role::where('name', 'docente')->first()->users;
        $requirements = $activity->requirements()->paginate(5);
        return view('auth.profiles.activity', [
            'docentes' => $docentes,
            'activity' => $activity,
            'requirements' => $requirements
        ]);
    }
}
