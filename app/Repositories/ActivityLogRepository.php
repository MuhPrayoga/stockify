<?php

namespace App\Repositories;

use App\Models\ActivityLog;

class ActivityLogRepository
{
    public function create(array $data)
    {
        return ActivityLog::create($data);
    }

    public function getAll()
    {
        return ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByUser($userId)
    {
        return ActivityLog::with('user')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
