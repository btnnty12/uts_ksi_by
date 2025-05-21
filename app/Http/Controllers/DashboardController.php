<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with statistics.
     */
    public function index(): View
    {
        $stats = [
            'totalStudents' => Student::count(),
            'totalClasses' => ClassRoom::count(),
            'totalUsers' => User::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
