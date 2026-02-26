<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryService
{
    protected $repo;

    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function store($request)
    {
        return $this->repo->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }
    
    public function update($id, $request)
    {
        return $this->repo->update($id, [
            'name' => $request->name,
            'description' => $request->description,
        ]);
    }

    public function destroy($id)
    {
        return $this->repo->delete($id);
    }
}
