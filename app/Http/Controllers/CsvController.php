<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function uploadCsv(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        // Get the uploaded file
        $csvFile = $request->file('csv_file');

        // Generate a unique filename
        $filename = uniqid('csv_') . '.' . $csvFile->getClientOriginalExtension();

        // Move the uploaded file to the desired folder
        $csvFile->move(public_path('csv_files'), $filename);

        // Optionally, you can return a response or redirect back with a success message
        return redirect()->back()->with('success', 'CSV file uploaded successfully.');
    }

    public function parseCsv(Request $request)
    {
        // Validate the request
        $request->validate([
            'filename' => 'required|string' // Assuming filename is sent in the request
        ]);

        // Get the filename from the request
        $filename = $request->filename;

        // Get the path to the uploaded CSV file
        $filePath = public_path('csv_files/' . $filename);

        // Initialize an array to store the parsed people
        $parsedPeople = [];

        // Open the CSV file for reading
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            // Read each line of the CSV file
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // Process each row of data
                foreach ($data as $name) {
                    // Split the name into individual parts
                    $parts = preg_split('/\b(?:and|&)\b/i', $name);

                    // Initialize an array to store the parsed person
                    foreach ($parts as $part) {
                        $parsedPerson = [];

                        // Extract title, first name, initial, and last name from the part
                        preg_match('/^(?P<title>[^\s]+)\s*(?P<first_name>[^\s]*)\s*(?P<initial>[^\s]*)\s*(?P<last_name>[^\s]+)$/i', $part, $matches);

                        // Assign parsed values to appropriate fields
                        $parsedPerson['title'] = $matches['title'] ?? null;
                        $parsedPerson['first_name'] = $matches['first_name'] ?? null;
                        $parsedPerson['initial'] = $matches['initial'] ?? null;
                        $parsedPerson['last_name'] = $matches['last_name'] ?? null;

                        // Add the parsed person to the array
                        $parsedPeople[] = $parsedPerson;
                    }
                }
            }

            // Close the CSV file
            fclose($handle);
        }

        // Return the array of parsed people
        return $parsedPeople;
    }
}
