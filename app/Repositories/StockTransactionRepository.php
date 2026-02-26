<?php

namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    public function create(array $data)
    {
        return StockTransaction::create($data);
    }

    public function findWithProduct($id)
    {
        return StockTransaction::with('product')->findOrFail($id);
    }

    public function getAll()
    {
        return StockTransaction::with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByUser($userId)
    {
        return StockTransaction::with('product')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
