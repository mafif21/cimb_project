<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Category;
use Location\Coordinate;
use Location\Distance\Vincenty;

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
        
        if (!empty($request->category_id)) {
            $branches->where('category_id', $request->category_id);
        }
        if (!empty($request->search)) {
            $search = strtolower($request->search); // Ubah input pencarian menjadi huruf kecil
            $branches->whereRaw('LOWER(name) like ?', ['%'.$search.'%'])
                ->orWhereRaw('LOWER(address) like ?', ['%'.$search.'%'])
                ->orWhereRaw('LOWER(phone) like ?', ['%'.$search.'%']);
        }

        $branches = $branches->get();

        if (!empty($request->user_lat && !empty($request->user_long))) {
            $originCordinate = new Coordinate($request->user_lat, $request->user_long);
            $range = 10000;
            $data = [];
            foreach($branches as $branch) {
                $branchCordinate = new Coordinate($branch->latitude, $branch->longitude);
                $distance = $originCordinate->getDistance($branchCordinate, new Vincenty());
                if ($distance <= $range) {
                    $branch->distance = $distance / 1000;
                    $data[] = $branch;
                }
            }
            $branches = $data;
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $branches,
        ]);
    }
}
