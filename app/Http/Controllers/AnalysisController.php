<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Services\AnalysisService;
use Illuminate\Http\Response;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $startDate = '2022-08-01';
        $endDate = '2022-08-31';

        $subQuery = Order::betweenDate($startDate, $endDate)
        ->groupBy('id')
        ->selectRaw('id, customer_id, customer_name, SUM(subtotal) as
        totalPerPurchase');

        $subQuery = DB::table($subQuery)
        ->groupBy('customer_id')
        ->selectRaw('customer_id, sum(totalPerPurchase)
        as total')
        ->orderBy('total', 'desc')->get();
        // dd($subQuery);

        return Inertia::render('Analysis');


    }
}
