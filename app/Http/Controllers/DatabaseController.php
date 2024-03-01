<?php
// app/Http/Controllers/DatabaseController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function backupDatabase(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $currentDateTime = now()->format('YmdHis');

            $backupFileName = "backup_{$currentDateTime}.sql";

            $command = "mysqldump -u root -h 127.0.0.1 students_record_system > " . storage_path("app/{$backupFileName}");

            // Execute the command
            exec($command, $output, $returnCode);

            // Check if the command was successful
            if ($returnCode === 0) {
                // Get the authenticated user's ID
                $userId = Auth::id();

                // Insert the backup log
                DB::table('backup_logs')->insert([
                    'filename' => $backupFileName,
                    'backup_datetime' => $currentDateTime,
                    'created_at' =>  $currentDateTime,
                    // 'backuped_by' => $userId,
                ]);

                return redirect()->back()->with('success', 'Database backup completed');
            } else {
                return redirect()->back()->with('error', 'Database backup failed')->with('output', $output);
            }
        } else {
            // Redirect or handle the case where the user is not authenticated
            return redirect()->back()->with('error', 'User not authenticated');
        }
    }
}
