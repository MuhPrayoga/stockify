<?php

namespace App\Http\Controllers;

use App\Services\StockTransactionService;
use Illuminate\Http\Request;
use App\Models\StockTransaction;

class StockTransactionController extends Controller
{
    protected $service;

    public function __construct(StockTransactionService $service)
    {
        $this->service = $service;
    }

    // STAFF
    public function storeIncoming(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $trx = $this->service->createIncoming($request);

        return response()->json([
            'success' => true,
            'message' => 'Barang masuk berhasil diajukan',
            'data'    => $trx
        ]);
    }

    public function storeOutgoing(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $trx = $this->service->createOutgoing($request);

        return response()->json([
            'success' => true,
            'message' => 'Barang keluar berhasil diajukan',
            'data'    => $trx
        ]);
    }

    // MANAGER / ADMIN
    public function approve($id)
    {
        try {
            $this->service->approve($id);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    
    public function complete($id)
    {
        $transaction = StockTransaction::with('product')->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        if (!in_array($transaction->status, ['Diterima', 'Dikeluarkan'])) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi belum bisa diselesaikan'
            ], 400);
        }

        $product = $transaction->product;

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        // Update stock
        if ($transaction->type === 'Masuk') {
            $product->stock += $transaction->quantity;
        } else {
            if ($product->stock < $transaction->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock tidak cukup'
                ], 400);
            }

            $product->stock -= $transaction->quantity;
        }

        $product->save();

        // Update status
        $transaction->update([
            'status' => 'Selesai'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil diselesaikan'
        ]);
    }

    public function reject($id)
    {
        try {
            $this->service->reject($id);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    // READ
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->all()
        ]);
    }

    public function myTransactions()
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->myTransactions()
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->findById($id)
        ]);
    }

}

