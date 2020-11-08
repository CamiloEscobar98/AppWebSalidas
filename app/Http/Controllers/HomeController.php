<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $programs = \App\Models\Program::all();
        $document_types = \App\Models\Document_type::all();
        return view('home')->with('document_types', $document_types)->with('programs', $programs);
    }

    // Lists
    public function studentsList()
    {
        $students = \App\Models\Role::find(2)->users()->orderBy('name', 'ASC')->paginate(8);
        $programs = \App\Models\Program::orderBy('faculty_id', 'ASC')->get();
        $dtypes = \App\Models\Document_type::all();
        // return $students;
        return view('auth.lists.students')->with('students', $students)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function teachersList()
    {
        $teachers = \App\Models\Role::find(3)->users()->orderBy('name', 'ASC')->paginate(8);
        $programs = \App\Models\Program::orderBy('faculty_id', 'ASC')->get();
        $dtypes = \App\Models\Document_type::all();
        // return $teachers;
        return view('auth.lists.teachers')->with('teachers', $teachers)->with('programs', $programs)->with('document_types', $dtypes);
    }
    public function directorsList()
    {
        $directors = \App\Models\Role::find(4)->users()->orderBy('name', 'ASC')->paginate(8);
        $programs = \App\Models\Program::orderBy('faculty_id', 'ASC')->get();
        $dtypes = \App\Models\Document_type::all();
        // return $directors;
        return view('auth.lists.directors')->with('directors', $directors)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function facultiesList()
    {
        $faculties = \App\Models\Faculty::paginate(5);
        return view('auth.lists.faculties')->with('faculties', $faculties);
    }

    // Profiles

    public function showStudent(\App\User $student)
    {
        $programs = \App\Models\Program::all();
        $dtypes = \App\Models\Document_type::all();
        return view('auth.profiles.student')->with('student', $student)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function showTeacher(\App\User $teacher)
    {
        $programs = \App\Models\Program::all();
        $dtypes = \App\Models\Document_type::all();
        return view('auth.profiles.teacher')->with('teacher', $teacher)->with('programs', $programs)->with('document_types', $dtypes);
    }

    public function showDirector(\App\User $director)
    {
        $programs = \App\Models\Program::all();
        $dtypes = \App\Models\Document_type::all();
        return view('auth.profiles.director')->with('director', $director)->with('programs', $programs)->with('document_types', $dtypes);
    }
}
