<?php

namespace App\Http\Controllers;

use App\Models\NoteAct;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the activity logs.
     */
    public function index(): View
    {
        $logs = NoteAct::with('user')
            ->latest()
            ->paginate(20);
            
        return view('activity.index', compact('logs'));
    }
    
    /**
     * Show filtered logs based on criteria.
     */
    public function filter(Request $request): View
    {
        $query = NoteAct::with('user');
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        
        if ($request->filled('table_name')) {
            $query->where('table_name', $request->table_name);
        }
        
        $logs = $query->latest()->paginate(20);
        
        return view('activity.index', compact('logs'));
    }
}
