<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function products(Request $request)
    {
        $perPage = max(1, min((int) $request->input('per_page', 20), 100));
        $paginator = Product::query()
            ->when($request->search, fn($q, $search) => $q->where(
                fn($q) => $q->where('name', 'like', "{$search}%")
                    ->orWhere('sku', 'like', "{$search}%")
            ))
            ->select('id', 'sku', 'name', 'sale_price', 'minimum_stock', 'is_active')
            ->paginate($perPage)
            ->withQueryString();

        return inertia('app/catalog/Products', [
            'products' => $paginator->items(),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'next_page_url' => $paginator->nextPageUrl(),
                'total' => $paginator->total(),
            ],
            'initialSearch' => $request->search,
        ]);
    }

    public function categories(Request $request)
    {
        $perPage = max(1, min((int) $request->input('per_page', 20), 100));
        $paginator = Category::query()
            ->when($request->search, fn($q, $search) => $q->where(
                'name',
                'like',
                "{$search}%"
            ))
            ->select('id', 'name', 'description', 'is_active')
            ->paginate($perPage)
            ->withQueryString();

        return inertia('app/catalog/Categories', [
            'categories' => $paginator->items(),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'next_page_url' => $paginator->nextPageUrl(),
                'total' => $paginator->total(),
            ],
            'initialSearch' => $request->search,
        ]);
    }
}
