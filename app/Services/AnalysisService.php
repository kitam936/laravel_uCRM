<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;


class AnalysisService
{
    public static function perDay($subQuery)
    {
        $query=  $subQuery->where('status',true)
            ->groupBy('id')
            ->selectRaw('id,sum(subtotal) as totalPerPurchase,
            DATE_FORMAT(created_at, "%Y%m%d") as date');

        $data = DB::table($query)
            ->groupBy('date')
            ->selectRaw('date, sum(totalPerPurchase) as total')->get();

        $labels = $data->pluck('date');
        $totals = $data->pluck('total') ;

        return [$data, $labels, $totals];

    }

    public static function perMonth($subQuery)
    {
        $query=  $subQuery->where('status',true)
            ->groupBy('id')
            ->selectRaw('id,sum(subtotal) as totalPerPurchase,
            DATE_FORMAT(created_at, "%Y%m") as date');

        // 現在の月別データ
        $data = DB::table($query)
            ->groupBy('date')
            ->selectRaw('date, sum(totalPerPurchase) as total')->get();

        // 前年同月のデータを取得
        $previousYearData = DB::table($query)
            ->groupBy('date')
            ->selectRaw('DATE_FORMAT(DATE_SUB(STR_TO_DATE(date, "%Y%m"), INTERVAL 1 YEAR), "%Y%m") as previous_date,
                        sum(totalPerPurchase) as previous_total')
            ->get();

        // データのマージ
        $mergedData = $data->map(function ($item) use ($previousYearData) {
        $previous = $previousYearData->firstWhere('previous_date', $item->date);
        $item->previous_total = $previous->previous_total ?? 0; // 前年同月のデータを結合
        return $item;
    });

        $labels = $data->pluck('date');
        $totals = $data->pluck('total') ;
        $previousTotals = $mergedData->pluck('previous_total');

        // dd($previousTotals);

        return [$mergedData, $labels, $totals, $previousTotals];

    }

    public static function perYear($subQuery)
    {
        $query=  $subQuery->where('status',true)
            ->groupBy('id')
            ->selectRaw('id,sum(subtotal) as totalPerPurchase,
            DATE_FORMAT(created_at, "%Y") as date');

        $data = DB::table($query)
            ->groupBy('date')
            ->selectRaw('date, sum(totalPerPurchase) as total')->get();

        $labels = $data->pluck('date');
        $totals = $data->pluck('total') ;

        return [$data, $labels, $totals];

    }
}



