<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassRoomController extends Controller
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
        $classes = ClassRoom::orderBy('name')->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:classes',
        ]);

        $class = ClassRoom::create($validated);
        
        // Log activity
        ActivityLogger::log('create', 'classes', $class->id);

        return redirect()->route('classes.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $class): View
    {
        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $class): View
    {
        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $class): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:classes,name,' . $class->id,
        ]);

        $class->update($validated);
        
        // Log activity
        ActivityLogger::log('update', 'classes', $class->id);

        return redirect()->route('classes.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $class): RedirectResponse
    {
        // Store ID for activity log before deletion
        $classId = $class->id;
        
        $class->delete();
        
        // Log activity
        ActivityLogger::log('delete', 'classes', $classId);

        return redirect()->route('classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
