<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // ===== SUMMARY =====
        $lowStock = Product::whereColumn('stock', '<=', 'minimum_stock')->count();

        $stockInToday = StockTransaction::where('type', 'Masuk')
            ->where('type', 'Masuk')
            ->where('created_at', '>=', now()->startOfDay())
            ->count();

        $stockOutToday = StockTransaction::where('type', 'Keluar')
            ->where('type', 'Keluar')
            ->where('created_at', '>=', now()->startOfDay())
            ->count();

        $pending = StockTransaction::where('status', 'Pending')->count();

        // ===== CHART 7 HARI TERAKHIR =====
        $last7Days = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i);
        });

        $chartData = [];

        foreach ($last7Days as $day) {

            $chartData[] = [
                'date' => $day->format('Y-m-d'),

                'masuk' => StockTransaction::where('type', 'Masuk')
                    ->whereBetween('created_at', [
                        $day->copy()->startOfDay(),
                        $day->copy()->endOfDay()
                    ])
                    ->count(),

                'keluar' => StockTransaction::where('type', 'Keluar')
                    ->whereBetween('created_at', [
                        $day->copy()->startOfDay(),
                        $day->copy()->endOfDay()
                    ])
                    ->count(),
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'low_stock' => $lowStock,
                'stock_in_today' => $stockInToday,
                'stock_out_today' => $stockOutToday,
                'pending' => $pending,
                'chart' => $chartData
            ]
        ]);
    }
}