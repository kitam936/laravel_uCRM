<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\AnalysisService;


class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $subQuery = Order::betweenDate($request->startDate,$request->endDate);

        if($request->type === 'perDay'){
            list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
            };

        if($request->type === 'perMonth'){
            list($mergedData, $labels, $totals,$previousTotals) = AnalysisService::perMonth($subQuery);
            return response()->json([
                'data'=> $mergedData,
                'type' => $request->type,
                'labels'=> $labels,
                'totals'=> $totals,
                'previousTotals' =>$previousTotals
            ],Response::HTTP_OK);
            };


        if($request->type === 'perYear'){
            list($data, $labels, $totals) = AnalysisService::perYear($subQuery);
            };


        return response()->json([
            'data'=> $data,
            'type' => $request->type,
            'labels'=> $labels,
            'totals'=> $totals,
            // 'previousTotals' =>$previousTotals
        ],Response::HTTP_OK);
    }
}
