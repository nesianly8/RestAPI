<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandDetailResource;

class BrandController extends Controller
{
    public function index() {

        $brands = Brand::with('writer:id,username')->get();
        return response()->json(['data_brand' => $brands], 200);

        // return BrandDetailResource::collection($brands);
    }

    public function show($id) {

        $brand = Brand::with('writer:id,username')->findOrFail($id);
        return new BrandDetailResource ($brand);
    }
    public function show2($id) {

        $brand = Brand::findOrFail($id);
        return new BrandDetailResource ($brand);
    }

    public function store(Request $request) {

        // return response()->json([
        //     'request-all' => $request->all(),
        // ]);

        $brand = Brand::create($request->all());
        return response()->json(['msg' => 'Data created', 'data' => $brand], 201);
    }

    function update($id, Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|max:45',
            'description' => 'required',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        return new BrandDetailResource($brand->loadMissing('writer:id,username'));
        // return response()->json(['msg' => 'Data updated', 'data' => $brand], 200);
    }

    function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
