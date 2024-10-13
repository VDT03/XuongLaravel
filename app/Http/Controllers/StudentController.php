<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::latest('id')->paginate(5);

        return view('students.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('students.create', compact('classrooms', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = Student::create($request->only(['name', 'email', 'classroom_id']));
        $student->passport()->create($request->only(['passport_number', 'issued_date', 'expiry_date']));
        $student->subjects()->attach($request->subjects);

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $data = Student::with('passport', 'classroom', 'subjects')->findOrFail($student->id);

        return view('students.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student = Student::with('passport', 'subjects')->findOrFail($student->id);
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('students.edit', compact('student', 'classrooms', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $student = Student::findOrFail($student->id);
        $student->update($request->only(['name', 'email', 'classroom_id']));
        $student->passport()->update($request->only(['passport_number', 'issued_date', 'expiry_date']));
        $student->subjects()->sync($request->subjects);

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student = Student::findOrFail($student->id);
        $student->delete();

        return redirect()->route('students.index');
    }
}
