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

        // Return the filename
        return response()->json(['filename' => $filename], 200);
    }
}
