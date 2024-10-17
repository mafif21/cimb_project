<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Branch;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        return view('landing.index', ['categories' => $categories]);
    }

    public function test()
    {
        $categories = Category::orderBy('id')->get();
        $branches = Branch::all();
        return view('landing.test', compact("categories", "branches"));
    }
}
