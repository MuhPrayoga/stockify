<?php

namespace App\Services;

use App\Repositories\ActivityLogRepository;

class ActivityLogService
{
    protected $repository;

    public function __construct(ActivityLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function log($action, $description)
    {
        return $this->repository->create([
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }

    public function all()
    {
        return $this->repository->getAll();
    }

    public function myLogs()
    {
        return $this->repository->getByUser(auth()->id());
    }
}
