<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;

class StockReportController extends Controller
{
    public function stockReport()
    {
        $products = Product::with('category')
            ->select('id', 'name', 'category_id', 'stock', 'minimum_stock')
            ->get()
            ->map(function ($product) {
                return [
                    'product_id'    => $product->id,
                    'product_name'  => $product->name,
                    'category'      => optional($product->category)->name ?? '-',
                    'stock'         => $product->stock,
                    'minimum_stock' => $product->minimum_stock,
                    'status'        => $product->stock <= $product->minimum_stock
                        ? 'MENIPIS'
                        : 'AMAN'
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Stock report retrieved',
            'data'    => $products
        ]);
    }

    public function lowStock()
    {
        $products = Product::whereColumn('stock', '<=', 'minimum_stock')
            ->select('id', 'name', 'sku', 'stock', 'minimum_stock')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Low stock alert',
            'data'    => $products
        ]);
    }

    public function transactionReport()
    {
        $transactions = StockTransaction::with([
            'product:id,name',
            'user:id,name'
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Transaction report retrieved',
            'data'    => $transactions
        ]);
    }
}
