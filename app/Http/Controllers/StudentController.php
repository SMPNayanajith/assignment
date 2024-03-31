<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return inertia('Students/Index', ['students' => $students]);
    }

    public function create()
    {
        return inertia('Students/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:2048', // Assuming image file
            'age' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        $student = new Student();
        $student->name = $request->name;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
            $student->image = $imagePath;
        }

        $student->age = $request->age;
        $student->status = $request->status;
        $student->save();

        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return inertia('Students/Edit', ['student' => $student]);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:2048', // Assuming image file
            'age' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        $student->name = $request->name;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
            $student->image = $imagePath;
        }

        $student->age = $request->age;
        $student->status = $request->status;
        $student->save();

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}
