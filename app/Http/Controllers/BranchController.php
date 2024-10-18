<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchCreateRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $branches = Branch::with('category')->select('branches.*');
        return DataTables::of($branches)
            ->addColumn('action', function($row){
                return '<a href="'.route('admin.branch.show', $row->id).'" class="font-medium text-blue-600">Detail</a>';
            })
            ->make(true);
    }

    $headers = [
        'Branch Name',
        'Address',
        'Phone',
        'Days Open',
        'Hours Open',
        'Latitude',
        'Longitude',
        'Category',
        'Action',
    ];

    return view('admin.branch.index', compact('headers'));
}

    public function create()
    {
        $categories = Category::all();
        return view('admin.branch.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|min:5|max:255',
            'days_open' => 'required',
            'hours_open' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Branch::create($validatedData);
        return to_route('admin.branch.index')->with('success', 'Add Branch Success');
    }

    public function show(Branch $branch)
    {
        return view('admin.branch.show', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        $categories = Category::all();
        return view('admin.branch.edit', compact('branch', 'categories'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|min:5|max:255',
            'days_open' => 'required',
            'hours_open' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $branch->update($validatedData);
        return redirect()->route('admin.branch.index')->with('primary', 'Cabang berhasil diperbarui.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branch.index')->with('danger', 'Cabang berhasil dihapus.');
    }
}
