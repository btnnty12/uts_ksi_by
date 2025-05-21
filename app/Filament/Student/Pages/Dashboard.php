<?php

namespace App\Filament\Student\Pages;

use App\Models\Student;
use Filament\Pages\Dashboard as BasePage;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static string $view = 'filament.student.pages.dashboard';
    
    public function getTitle(): string 
    {
        return 'Dashboard Siswa';
    }
    
    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
    
    public function getStudentData()
    {
        $user = Auth::user();
        
        // Get student data if available
        $student = Student::where('name', 'like', '%' . $user->name . '%')
            ->first();
            
        return $student ?? null;
    }
} 