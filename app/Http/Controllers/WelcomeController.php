<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;

class WelcomeController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        $categories = Category::all();

        return view('welcome', [
            'locations' => $locations,
            'categories' => $categories,
        ]);
    }
}
