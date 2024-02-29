<?php
// app/Console/Commands/BackupDatabase.php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup the database using mysqldump';

    public function handle()
    {
        // Get database configuration
        $databaseName = config('database.connections.mysql.database');
        $databaseUser = config('database.connections.mysql.username');
        $databasePassword = config('database.connections.mysql.password');

        // Generate the backup filename with timestamp
        $backupFileName = 'backup_' . date('YmdHis') . '.sql';

        // Construct the mysqldump command
        $command = "mysqldump --user={$databaseUser} --password={$databasePassword} --host=localhost {$databaseName} > storage/app/{$backupFileName}";

        // Execute the command
        $result = shell_exec($command);

        $this->info("Database backup completed. Filename: {$backupFileName}");
    }

}
