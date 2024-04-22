<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function upload(Request $request)
    {
        // Mock upload for now
        $parsedData = [
            ['title' => 'Mr', 'first_name' => 'John', 'initial' => null, 'last_name' => 'Smith'],
            ['title' => 'Mrs', 'first_name' => 'Jane', 'initial' => null, 'last_name' => 'Smith'],
            ['title' => 'Mister', 'first_name' => 'John', 'initial' => null, 'last_name' => 'Doe'],
            ['title' => 'Mr', 'first_name' => 'Bob', 'initial' => null, 'last_name' => 'Lawblaw'],
            ['title' => 'Mr', 'first_name' => null, 'initial' => null, 'last_name' => 'Smith'],
            ['title' => 'Mr', 'first_name' => 'Craig', 'initial' => null, 'last_name' => 'Charles'],
            ['title' => 'Mr', 'first_name' => 'M', 'initial' => null, 'last_name' => 'Mackie'],
            ['title' => 'Mrs', 'first_name' => 'Jane', 'initial' => null, 'last_name' => 'McMaster'],
            ['title' => 'Mr', 'first_name' => 'Tom', 'initial' => null, 'last_name' => 'Staff'],
            ['title' => 'Mr', 'first_name' => 'John', 'initial' => null, 'last_name' => 'Doe'],
            ['title' => 'Dr', 'first_name' => 'P', 'initial' => null, 'last_name' => 'Gunn'],
            ['title' => 'Dr', 'first_name' => null, 'initial' => null, 'last_name' => 'Joe'],
            ['title' => 'Ms', 'first_name' => 'Claire', 'initial' => null, 'last_name' => 'Robbo'],
            ['title' => 'Prof', 'first_name' => 'Alex', 'initial' => null, 'last_name' => 'Brogan'],
            ['title' => 'Mrs', 'first_name' => 'Faye', 'initial' => null, 'last_name' => 'Hughes-Eastwood'],
            ['title' => 'Mr', 'first_name' => 'F.', 'initial' => null, 'last_name' => 'Fredrickson'],
        ];

        return response()->json($parsedData);
    }
}
