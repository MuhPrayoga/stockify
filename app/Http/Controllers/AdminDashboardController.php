<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        return response()->json([
            'success' => true,
            'data' => [
                // SUMMARY
                'total_products' => Product::count(),

                'total_stock_in' => StockTransaction::where('type', 'Masuk')
            ->where('type', 'Masuk')
            ->where('created_at', '>=', now()->startOfDay())
            ->count(),

                'total_stock_out' => StockTransaction::where('type', 'Keluar')
            ->where('type', 'Keluar')
            ->where('created_at', '>=', now()->startOfDay())
            ->count(),

                'low_stock_products' => Product::whereColumn(
                    'stock',
                    '<=',
                    'minimum_stock'
                )->count(),

                // DIPAKSA ADA KARENA admin.js PAKE
                'pending_transactions' => StockTransaction::where(
                    'status',
                    'Pending'
                )->count(),

                // ACTIVITY LOG (WAJIB ADA action & description)
                'recent_activities' => ActivityLog::select(
                        'action',
                        'description'
                    )
                    ->latest()
                    ->limit(5)
                    ->get(),
            ]
        ]);
    }

    // Chart untuk dashboard admin
    public function stockChart()
    {
        $year = Carbon::now()->year;

        $data = DB::table('stock_transactions')
            ->selectRaw('
                MONTH(created_at) as month,
                SUM(CASE WHEN type = "Masuk" THEN quantity ELSE 0 END) as stock_in,
                SUM(CASE WHEN type = "Keluar" THEN quantity ELSE 0 END) as stock_out
            ')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json([
            'success' => true,
            'year' => $year,
            'data' => $data
        ]);
    }

    public function productCategoryChart()
    {
        $data = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('COUNT(products.id) as total'))
            ->groupBy('categories.name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function lowStockChart()
    {
        $products = Product::whereColumn('stock', '<=', 'minimum_stock')
            ->select('name', 'stock')
            ->orderBy('stock', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
