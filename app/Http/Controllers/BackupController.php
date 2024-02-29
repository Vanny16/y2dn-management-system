<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function dumpDatabase()
    {
        // // Use the backup package if installed
        // if (class_exists('\Spatie\Backup\BackupServiceProvider')) {
        //     Artisan::call('backup:run');
        //     return redirect()->back()->with('success', 'Database backed up successfully.');
        // }

        //  // If backup package not installed, use mysqldump command
        //  $outputPath = storage_path('app/backups/backup.sql');

        //  // Ensure the backups directory exists
        //  if (!is_dir(dirname($outputPath))) {
        //      mkdir(dirname($outputPath), 0755, true);
        //  }

        // // If backup package not installed, use mysqldump command

        // $command = "mysqldump -u " . env('DB_USERNAME') . " -p" . env('DB_PASSWORD') . " " . env('DB_DATABASE') . " > $outputPath";
        // exec($command);

        // return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
