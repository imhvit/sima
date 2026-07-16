<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Category::create($request->validated());
            });

            return back()->with('success', 'Categoría creada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error creando categoría: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error interno al crear la categoría.');
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            DB::transaction(function () use ($request, $category) {
                $category->update($request->validated());
            });

            return back()->with('success', 'Categoría actualizada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error actualizando categoría: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al actualizar la categoría.');
        }
    }

    public function delete(Category $category)
    {
        $category->delete();
    }
}
