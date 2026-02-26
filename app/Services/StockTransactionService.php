<?php

namespace App\Services;

use App\Repositories\StockTransactionRepository;
use Carbon\Carbon;
use App\Models\StockTransaction;
use App\Services\ActivityLogService;

class StockTransactionService
{
    protected $repository;
    protected $activityLog;

    public function __construct(
        StockTransactionRepository $repository,
        ActivityLogService $activityLog
    ) {
        $this->repository = $repository;
        $this->activityLog = $activityLog;
    }

    // ================= STAFF =================
    public function createIncoming($request)
    {
        $trx = $this->repository->create([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'type'       => 'Masuk',
            'status'     => 'Pending',
            'user_id'    => auth()->id(),
            'date'       => Carbon::now(),
            'notes'      => $request->notes,
        ]);

        // ACTIVITY LOG
        $this->activityLog->log(
            'CREATE_STOCK_IN',
            'Mengajukan barang masuk (ID Transaksi: ' . $trx->id . ')'
        );

        return $trx;
    }

    public function createOutgoing($request)
    {
        $trx = $this->repository->create([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'type'       => 'Keluar',
            'status'     => 'Pending',
            'user_id'    => auth()->id(),
            'date'       => Carbon::now(),
            'notes'      => $request->notes,
        ]);

        // ACTIVITY LOG
        $this->activityLog->log(
            'CREATE_STOCK_OUT',
            'Mengajukan barang keluar (ID Transaksi: ' . $trx->id . ')'
        );

        return $trx;
    }

    // ================= MANAGER / ADMIN =================
    public function approve($id)
    {
        $trx = $this->repository->findWithProduct($id);

        if ($trx->status !== 'Pending') {
            throw new \Exception('Transaksi sudah diproses');
        }

        if ($trx->type === 'Masuk') {
            $trx->status = 'Diterima';
        }

        if ($trx->type === 'Keluar') {

            $trx->status = 'Dikeluarkan';
        }

        $trx->approved_by = auth()->id();
        $trx->approved_at = Carbon::now();
        $trx->save();

        // ACTIVITY LOG
        $this->activityLog->log(
            'APPROVE_STOCK',
            'Menyetujui transaksi stok (ID: ' . $trx->id . ')'
        );

        return $trx;
    }

    public function complete($id)
    {
        $trx = $this->repository->findWithProduct($id);

        if (!in_array($trx->status, ['Diterima', 'Dikeluarkan'])) {
            throw new \Exception('Transaksi belum disetujui');
        }

        if ($trx->status === 'Completed') {
            throw new \Exception('Transaksi sudah diselesaikan');
        }

        if ($trx->type === 'Masuk') {
            $trx->product->increment('stock', $trx->quantity);
        }

        if ($trx->type === 'Keluar') {
            if ($trx->product->stock < $trx->quantity) {
                throw new \Exception('Stok tidak cukup');
            }

            $trx->product->decrement('stock', $trx->quantity);
        }

        $trx->status = 'Completed';
        $trx->save();

        $this->activityLog->log(
            'COMPLETE_STOCK',
            'Menyelesaikan transaksi stok (ID: ' . $trx->id . ')'
        );

        return $trx;
    }

    public function reject($id)
    {
        $trx = $this->repository->findWithProduct($id);

        if ($trx->status !== 'Pending') {
            throw new \Exception('Transaksi sudah diproses');
        }

        $trx->status = 'Ditolak';
        $trx->approved_by = auth()->id();
        $trx->approved_at = Carbon::now();
        $trx->save();

        // ACTIVITY LOG
        $this->activityLog->log(
            'REJECT_STOCK',
            'Menolak transaksi stok (ID: ' . $trx->id . ')'
        );

        return $trx;
    }

    // ================= READ =================
    public function all()
    {
        return $this->repository->getAll();
    }

    public function myTransactions()
    {
        return $this->repository->getByUser(auth()->id());
    }

    public function findById($id)
    {
        return StockTransaction::with(['product', 'user'])
            ->findOrFail($id);
    }
}
