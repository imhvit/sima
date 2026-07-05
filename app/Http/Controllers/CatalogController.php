<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function products()
    {
        $products = Product::select('id', 'sku', 'name', 'sale_price', 'minimum_stock', 'is_active')->get();
        return inertia('app/catalog/Products', ['products' => $products]);
    }
}
