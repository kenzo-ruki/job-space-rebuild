<?php

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Support\Facades\DB;

$app = require_once __DIR__.'/../bootstrap/app.php';

// Boot the application
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

// Enable query log
DB::enableQueryLog();

// Open the SQL file

/*
$file = fopen('cover_letters.sql', 'r');
*/
$file = fopen('user_jobseeker.sql', 'r');

DB::statement('SET FOREIGN_KEY_CHECKS=0;');

// Read the file line by line
$stmt = '';
while (($line = fgets($file)) !== false) {
    echo "Read line: $line\n";
    $stmt .= $line;
    if (substr(trim($line), -1) == ';' && str_starts_with(trim($stmt), 'INSERT INTO') && str_contains($stmt, 'VALUES')) {
        // A full SQL statement has been read; execute it
        echo "Executing statement line: $line\n";
        try {
            DB::statement($stmt);
        } catch (\Exception $e) {
            echo "Failed to execute statement line: $line', error: " . $e->getMessage() . "\n";
        }
        $stmt = '';
    }
}

DB::statement('SET FOREIGN_KEY_CHECKS=1;');

// Close the file
fclose($file);

// Dump the query log
dd(DB::getQueryLog());