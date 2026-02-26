<?php

namespace App\Repositories;

use App\Models\StockOpname;

class StockOpnameRepository
{
    public function create(array $data)
    {
        return StockOpname::create($data);
    }

    public function all()
    {
        return StockOpname::with(['product', 'checker'])
            ->orderBy('checked_at', 'desc')
            ->get();
    }
}
