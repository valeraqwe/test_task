<?php

namespace App\Console\Commands;

use App\Models\Data;
use Illuminate\Console\Command;

class ImportData extends Command
{
    protected $signature = 'import:data';
    protected $description = 'Import data from CSV and XML files into the database';

    public function handle()
    {
        // Your import logic goes here

        // Example CSV import
        $csvData = file('resources/data/data.csv');
        foreach ($csvData as $index => $row) {
            // Skip the first row (header row)
            if ($index === 0) {
                continue;
            }

            $data = str_getcsv($row);

            // Check if the row has the correct number of columns
            if (count($data) >= 6) {
                Data::updateOrCreate([
                    'ship_to_name' => $data[2],
                    'customer_email' => $data[3],
                ], [
                    'status' => $data[5],
                ]);
            }
        }

        // Example XML import
        // ... (same as before)

        $this->info('Data import completed successfully.');
    }
}
