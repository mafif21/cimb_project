<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Category;

class ApiController extends Controller
{
    public function getBranches(Request $request) 
    {   
        if (empty($request->category_id)) {
            return response()->json([
                'status' => 404,
                'message' => 'Kategori tidak boleh kosong.',
            ]);
        }
        $branches = Branch::query();
        
        if ($request->category_id) {
            $branches->where('category_id', $request->category_id);
        }
        if ($request->search) {
            $branches->where('name', 'like', '%'.$request->search.'%')
            ->orWhere('address', 'like', '%'.$request->search.'%')
            ->orWhere('phone', 'like', '%'.$request->search.'%');
        }
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $branches->get(),
        ]);
    }
}
