<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('admin.branch.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branch.create');
    }

    public function store(Request $request) {}

    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        //
    }

    public function update(Request $request, Branch $branch)
    {
        //
    }

    public function destroy(Branch $branch)
    {
        //
    }
}