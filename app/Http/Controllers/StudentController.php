<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::with(['class', 'creator'])->latest()->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $classes = ClassRoom::orderBy('name')->pluck('name', 'id');
        return view('students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'nisn' => 'required|string|max:20|unique:students',
            'class_id' => 'required|exists:classes,id',
            'birth_date' => 'required|date',
            'address' => 'required|string',
        ]);

        // Add the user who created this student
        $validated['created_by'] = Auth::id();

        $student = Student::create($validated);
        
        // Log activity
        ActivityLogger::log('create', 'students', $student->id);

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        $classes = ClassRoom::orderBy('name')->pluck('name', 'id');
        return view('students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'nisn' => 'required|string|max:20|unique:students,nisn,' . $student->id,
            'class_id' => 'required|exists:classes,id',
            'birth_date' => 'required|date',
            'address' => 'required|string',
        ]);

        $student->update($validated);
        
        // Log activity
        ActivityLogger::log('update', 'students', $student->id);

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        // Store ID for activity log before deletion
        $studentId = $student->id;
        
        $student->delete();
        
        // Log activity
        ActivityLogger::log('delete', 'students', $studentId);

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
