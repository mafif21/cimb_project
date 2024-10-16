<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchCreateRequest;
use App\Http\Requests\BranchUpdateRequest;
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

    public function store(BranchCreateRequest $request)
    {
        Branch::create($request->validated());
        return to_route('admin.branch.index')->with('success', 'Add Branch Success');
    }

    public function show(Branch $branch)
    {
        return view('admin.branch.show', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        return view('admin.branch.edit', compact('branch'));
    }

    public function update(BranchUpdateRequest $request, Branch $branch)
    {
        $branch->update($request->validated());
        return redirect()->route('admin.branch.index')->with('success', 'Cabang berhasil diperbarui.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branch.index')->with('success', 'Cabang berhasil dihapus.');
    }
}