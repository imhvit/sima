<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getDataTable(?string $search, int $perPage)
    {
        return Category::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "{$search}%");
            })
            ->select('id', 'name', 'description')
            ->paginate($perPage)
            ->withQueryString();
    }
}
