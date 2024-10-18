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
        if (empty($request->category_id) && !empty($request->search)) {
            return response()->json([
                'status' => 404,
                'message' => 'Kategori tidak boleh kosong.',
            ]);
        }
        $branches = Branch::query();

        $branches->select('branches.*', 'categories.name as category_name');
        $branches->leftJoin('categories', 'branches.category_id', '=', 'categories.id');
        $branches->where('latitude', '>=', -90)->where('latitude', '<=', 90);
        
        if (!empty($request->category_id)) {
            $branches->where('category_id', $request->category_id);
        }
        if (!empty($request->search)) {
            $search = strtolower($request->search); // Ubah input pencarian menjadi huruf kecil

            $branches->where(function($query) use ($search) {
                $query->whereRaw('LOWER(branches.name) like ?', ['%'.$search.'%'])
                    ->orWhereRaw('LOWER(branches.address) like ?', ['%'.$search.'%'])
                    ->orWhereRaw('LOWER(branches.phone) like ?', ['%'.$search.'%']);
            });
        }

        $branches = $branches->get();

        if (!empty($request->user_lat && !empty($request->user_long))) {
            $originCordinate = new Coordinate($request->user_lat, $request->user_long);
            $range = 10000;
            $data = [];
            foreach ($branches as $branch) {
                $branchCordinate = new Coordinate($branch->latitude, $branch->longitude);
                $distance = $originCordinate->getDistance($branchCordinate, new Vincenty());
                if ($distance <= $range) {
                    $branch->distance = $distance / 1000;
                    $data[] = $branch;
                }
            }
            $branches = $data;

            usort($branches, function($a, $b) {
                return $a['distance'] <=> $b['distance'];
            });
        }

        if($request->ai){
            $numPerCat = 5;
            $filteredData = [];
            $categoryCount = [];

            foreach ($data as $entry) {
                $category = $entry['category_name'];

                if (!isset($categoryCount[$category])) {
                    $categoryCount[$category] = 0;
                }

                if ($categoryCount[$category] < $numPerCat) {
                    $filteredData[] = $entry;
                    $categoryCount[$category]++;
                }
            }

            return $filteredData;
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $branches,
        ]);
    }

    private function _cityUserSearch($query){
        $response = \Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a system middleware that is useful for getting keywords in the form of cities from user input. The result of your work is only the city name. If there is no city name listed by the user, then return the value -.'],
                ['role' => 'user', 'content' => $query]
            ],
            'temperature' => 0.5
        ]);
        $aiProcessedQuery = $response->json('choices')[0]['message']['content'];
        return $aiProcessedQuery;
    }

    private function _openAIChat($query, $lat, $long)
    {
        $nearestBranches = [];
        $context_msg = [
            ['role' => 'system', 'content' => 'You are a helpful assistant that helps users find the appropriate CIMB Niaga service based on their query. Here are the services offered by CIMB Niaga: 
            - ATM: For cash withdrawals, transfers, balance checks, and bill payments, available 24/7.
            - CDM: For depositing cash directly into your account, available 24/7.
            - TST: A service available at select branches for both cash withdrawals and deposits, with a faster, tech-enhanced process.
            - Kantor Cabang: For full-service banking, including account opening, loan applications, and other complex transactions.
            - Digital Lounge: Self-service banking with advanced technology, video banking, and digital tools.
            - Kantor Cabang Pembantu: Smaller branch offices providing essential banking services, often in less populated areas.
            - KIOSK: Self-service terminals for checking balances, transferring funds, and bill payments.
            - Kantor Cabang Syariah: For banking services based on Islamic principles.
            - Kantor Fungsional Syariah: Supporting Islamic banking operations.
            - Kantor Cabang Pembantu Syariah: Smaller branches offering Sharia-compliant banking services.
            - Weekend Banking: Select branches open on weekends for basic banking services like deposits and withdrawals.'],
            ['role' => 'user', 'content' => $query],
            ['role' => 'system', 'content' => 'As a smart assistant, you need to answer customer questions specifically and based on data. In addition, you also need to adjust the language issued with the language inputted by the user.']
        ];

        $cityName = $this->_cityUserSearch($query);

        if(!empty($lat) || !empty($long)){
            $request = new Request([
                'user_lat' => $lat,
                'user_long' => $long,
                'ai' => true,
            ]);
            $nearestBranches = $this->getBranches($request);
            $serviceContext = "Here are the nearest branches and their services:\n";
            foreach ($nearestBranches as $branch) {
                $serviceContext .= "- " . $branch->name . " branch is located in " . $branch->address .  " providing services as a " . $branch->category_name . ", and is " . $branch->distance . " away." . "\n";
            }
            $context_msg = array_merge($context_msg, [['role' => 'system', 'content' => $serviceContext]]);
        }

        $response = \Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => $context_msg,
            'temperature' => 0.5
        ]);

        $aiProcessedQuery = $response->json('choices')[0]['message']['content'];
        $data = [
            'aiGenerated' => nl2br($aiProcessedQuery),
            'nearestBranches' => $nearestBranches,
        ];

        return $data;
    }

    public function askChatBot(Request $request)
    {
        try {
        $request->validate([
            'ask_query' => 'required|string',
        ]);

        $query = $request->input('ask_query');

        $res = $this->_openAIChat($query, $request->lat, $request->long);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $res,
        ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 400,
                'message' => 'success',
                'data' => $e->validator->errors(),
            ], 400);
        }
    }
}
