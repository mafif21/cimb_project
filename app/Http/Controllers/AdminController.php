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
            'totalATM' => Branch::where('category_id', 1)->count(),
            'totalCDM' => Branch::where('category_id', 2)->count(),
            'totalTST' => Branch::where('category_id', 3)->count(),
            'totalKC' => Branch::where('category_id', 4)->count(),
            'totalDigitalLounge' => Branch::where('category_id', 5)->count(),
            'totalSubBranch' => Branch::where('category_id', 6)->count(),
            'totalKiosk' => Branch::where('category_id', 7)->count(),
            'totalKCS' => Branch::where('category_id', 8)->count(),
            'totalKFS' => Branch::where('category_id', 9)->count(),
            'totalKCPS' => Branch::where('category_id', 10)->count(),
            'totalWeekendBanking' => Branch::where('category_id', 11)->count(),

        ];
        return view('admin.index', compact('data'));
    }
}