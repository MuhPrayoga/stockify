<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockOpnameService;

class StockOpnameController extends Controller
{
    protected $service;

    public function __construct(StockOpnameService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'notes' => 'nullable|string'
        ]);

        $data = $this->service->perform($request);

        return response()->json([
            'success' => true,
            'message' => 'Stock opname berhasil',
            'data' => $data
        ]);
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->history()
        ]);
    }
}

