<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ActivityLog;

class ChartController extends Controller
{
    //
    public function stockTransactionsChart(Request $request)
    {
        $year = $request->get('year', now()->year);

        $data = StockTransaction::select(
                DB::raw('MONTH(date) as month'),
                DB::raw("SUM(CASE WHEN type = 'Masuk' THEN quantity ELSE 0 END) as stock_in"),
                DB::raw("SUM(CASE WHEN type = 'Keluar' THEN quantity ELSE 0 END) as stock_out")
            )
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy('month')
            ->get();

        return response()->json([
            'success' => true,
            'year' => $year,
            'data' => $data
        ]);
    }

    public function stockByCategory()
    {
        $data = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category, SUM(products.stock) as total_stock')
            ->groupBy('categories.name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function userActivities()
    {
        $data = ActivityLog::select(
                'action',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('action')
            ->orderByDesc('total')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function productStockHistory($productId)
    {
        $data = StockTransaction::where('product_id', $productId)
            ->selectRaw('date, SUM(
                CASE 
                    WHEN type = "Masuk" THEN quantity 
                    WHEN type = "Keluar" THEN -quantity 
                    ELSE 0 
                END
            ) as stock_change')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
