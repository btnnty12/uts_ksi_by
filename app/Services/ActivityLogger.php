<?php

namespace App\Services;

use App\Models\NoteAct;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Log an activity.
     *
     * @param string $action
     * @param string $tableName
     * @param int $recordId
     * @return void
     */
    public static function log(string $action, string $tableName, int $recordId): void
    {
        if (!Auth::check()) {
            return;
        }

        NoteAct::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $recordId,
        ]);
    }
} 