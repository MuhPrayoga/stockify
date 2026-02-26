<?php

namespace App\Services\Stock;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockApprovalService
{
    public function approve($transactionId, $approverId)
    {
        return DB::transaction(function () use ($transactionId, $approverId) {

            $transaction = StockTransaction::lockForUpdate()->findOrFail($transactionId);

            if ($transaction->status !== 'Pending') {
                throw new \Exception('Transaksi sudah diproses');
            }

            $product = Product::lockForUpdate()->findOrFail($transaction->product_id);

            // Update stok
            if ($transaction->type === 'Masuk') {
                $product->stock += $transaction->quantity;
                $transaction->status = 'Diterima';
            }

            if ($transaction->type === 'Keluar') {

                if ($product->stock < $transaction->quantity) {
                    throw new \Exception('Stok tidak mencukupi');
                }

                $product->stock -= $transaction->quantity;
                $transaction->status = 'Dikeluarkan';
            }

            $product->save();

            $transaction->approved_by = $approverId;
            $transaction->approved_at = Carbon::now();
            $transaction->save();

            return $transaction;
        });
    }
}