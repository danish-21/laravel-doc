<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InsertCategory extends Command
{
    protected $signature = 'app:insert-category {csvFile}';
    protected $description = 'Insert categories from a CSV file';

    public function handle()
    {
        $csvFile = $this->argument('csvFile');

        if (!File::exists($csvFile)) {
            $this->error('The specified CSV file does not exist.');
            return;
        }

        $csvData = array_map('str_getcsv', file($csvFile));
        $header = array_shift($csvData);

        $insertData = [];

        foreach ($csvData as $row) {
            $parent_id = $row[2] !== '' ? (int)$row[2] : null;
            $file_id = $row[3] !== '' ? (int)$row[3] : null;
            $insertData[] = [
                'name' => $row[1],
                'parent_id' => $parent_id,
                'file_id' => $file_id,
                'is_active' => $row[4] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the categories table, specifying fields to insert
        DB::table('categories')->insert($insertData);

        $this->info('Categories inserted successfully.');
    }
}
