<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'unit']);
        return response()->json($product);
    }

    public function edit(Product $product)
    {
        $product->load(['category', 'brand', 'unit']);
        return response()->json($product);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Product::create($request->validated());
            });

            return back()->with('success', 'Producto creado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error creando producto: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error interno al crear el producto.');
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {
                $product->update($request->validated());
            });

            return back()->with('success', 'Producto actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error actualizando producto: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al actualizar el producto.');
        }
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
