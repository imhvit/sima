<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __construct(
        private readonly ProductRepository $productRepo,
        private readonly CategoryRepository $categoryRepo
    ) {}

    public function products(Request $request)
    {
        $perPage = $this->getPerPage($request);
        $paginator = $this->productRepo->getDataTable((string) $request->input('search'), $perPage);

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
            'initialSearch' => $request->input('search'),
        ]);
    }

    public function categories(Request $request)
    {
        $perPage = $this->getPerPage($request);
        $paginator = $this->categoryRepo->getDataTable((string) $request->input('search'), $perPage);

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

    private function getPerPage(Request $request): int
    {
        return max(1, min((int) $request->input('per_page', 20), 100));
    }
}
