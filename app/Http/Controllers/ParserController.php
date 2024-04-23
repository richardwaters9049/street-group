<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function parseCSVFile($filename)
    {
        // Get the path to the CSV file
        $filePath = public_path('csv_files/' . $filename);

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Initialize an array to store the parsed data
        $parsedData = [];

        // Open the CSV file for reading
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            // Read each line of the CSV file
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // Process each row of data
                // For simplicity, let's assume each row contains only one value
                foreach ($data as $value) {
                    // Add the value to the parsed data array
                    $parsedData[] = $value;
                }
            }

            // Close the CSV file
            fclose($handle);

            // Return the parsed data
            return response()->json($parsedData, 200);
        } else {
            // If unable to open the file, return an error response
            return response()->json(['error' => 'Unable to open the file'], 500);
        }
    }
}
