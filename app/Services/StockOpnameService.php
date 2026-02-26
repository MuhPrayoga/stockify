<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\StockOpnameRepository;
use App\Services\ActivityLogService;
use Carbon\Carbon;

class StockOpnameService
{
    protected $repository;
    protected $activityLog;

    public function __construct(
        StockOpnameRepository $repository,
        ActivityLogService $activityLog
    ) {
        $this->repository = $repository;
        $this->activityLog = $activityLog;
    }

    public function perform($request)
    {
        $product = Product::findOrFail($request->product_id);

        $systemStock = $product->stock;
        $physicalStock = $request->physical_stock;
        $difference = $physicalStock - $systemStock;

        // Update stok produk
        $product->update([
            'stock' => $physicalStock
        ]);

        // Simpan histori opname
        $opname = $this->repository->create([
            'product_id' => $product->id,
            'system_stock' => $systemStock,
            'physical_stock' => $physicalStock,
            'difference' => $difference,
            'notes' => $request->notes,
            'checked_by' => auth()->id(),
            'checked_at' => Carbon::now(),
        ]);

        // Activity log
        $this->activityLog->log(
            'STOCK_OPNAME',
            "Stock opname produk {$product->name}, selisih {$difference}"
        );

        return $opname;
    }

    public function history()
    {
        return $this->repository->all();
    }
}
