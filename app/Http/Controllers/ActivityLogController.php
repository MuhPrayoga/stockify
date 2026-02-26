<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    protected $service;

    public function __construct(ActivityLogService $service)
    {
        $this->service = $service;
    }

    // Admin & Manajer
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // optional filter
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        return response()->json([
            'success' => true,
            'data' => $query->paginate(10)
        ]);
    }

    // Log milik user sendiri (opsional)
    public function myLogs()
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->myLogs()
        ]);
    }

    
}
