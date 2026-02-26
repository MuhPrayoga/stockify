<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockTransactionService;
use App\Services\StockOpnameService;

class StaffDashboardController extends Controller
{
    protected $transactionService;
    protected $opnameService;

    public function __construct(
        StockTransactionService $transactionService,
        StockOpnameService $opnameService
    ) {
        $this->transactionService = $transactionService;
        $this->opnameService = $opnameService;
    }

    public function index()
    {
        $user = auth()->user();

        // Ambil transaksi milik staff
        $myTransactions = $this->transactionService->myTransactions();

        $todayIncoming = collect($myTransactions)
            ->where('type', 'Masuk')
            ->where('created_at', '>=', now()->startOfDay())
            ->count();

        $todayOutgoing = collect($myTransactions)
            ->where('type', 'Keluar')
            ->where('created_at', '>=', now()->startOfDay())
            ->count();

        $pending = collect($myTransactions)
            ->where('status', 'Pending')
            ->count();

        $opnameToday = collect($this->opnameService->history())
            ->where('created_at', '>=', now()->startOfDay())
            ->count();

        $jobs = collect($this->transactionService->myTransactions())
            ->whereIn('status', ['Diterima', 'Dikeluarkan'])
            ->values();
            
        return response()->json([
            'success' => true,
            'data' => [
                'today_in'   => $todayIncoming,
                'today_out'  => $todayOutgoing,
                'pending'    => $pending,
                'opname'     => $opnameToday,
                'jobs'       => $jobs,
            ]
        ]);
    }
}