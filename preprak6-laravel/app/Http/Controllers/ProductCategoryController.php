<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $queryData = ProductCategory::all();
            $formattedDatas = new ProductCategoryCollection($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response() -> json($e->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validateRequest = $request->validated();
        try {
            $queryData = ProductCategory::create($validateRequest);
            $formattedDatas = new ProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $queryData = ProductCategory::findOrFail($id);
            $formatterDatas = new ProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formatterDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        $validateRequest = $request->validated();
        try {
            $queryData = ProductCategory::findOrFail($id);
            $queryData->update($validateRequest);
            $queryData->save();
            $formattedDatas = new ProductCategoryResource($queryData);
            return response() -> json ([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);

        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $queryData = ProductCategory::findOrFail($id);
            $queryData->delete();
            $formattedDatas = new ProductCategoryResource($queryData);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}