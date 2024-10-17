<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class AdminController extends Controller
{
    public function index()
    {
        
        $data = [
            'totalUsers' => 1520,
            'totalOrders' => 350,
            'revenue' => 25000,
            'productsSold' => 1280,
            'totalBranches' => Branch::count(),
        ];
        return view('admin.index', compact('data'));
    }
}