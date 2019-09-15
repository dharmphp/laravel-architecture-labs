<?php

namespace App\Services;

use Illuminate\Support\LazyCollection;

class CsvStreamingService
{
    public function streamLargeCsv($filePath)
    {
        // memory usage remains under 2MB even for 500k rows!
        return LazyCollection::make(function () use ($filePath) {
            $handle = fopen($filePath, 'r');
            while (($line = fgetcsv($handle, 4096)) !== false) {
                yield $line;
            }
            fclose($handle);
        })
        ->skip(1) // header
        ->map(function ($row) {
            return [
                'code' => $row[0],
                'price' => (float)$row[1],
                'qty' => (int)$row[2]
            ];
        })
        ->filter(function ($item) {
            return $item['qty'] > 0;
        });
    }
}
