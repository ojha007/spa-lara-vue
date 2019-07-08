<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Brand;
use App\Http\Models\Product;
use App\Http\Models\ProductMetaKey;
use App\Http\Models\ProductMetaValue;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {

        if ($request->tags == 2) {
            $product= Product::with('brand')->orderBy('availability');
        }
        $product= Product::with('brand')->paginate(20);
        return response()->json($product);
    }

    public function productCount()
    {
        return Product::count();
    }

    public function show($id)
    {
        $product = [];
        $product['name'] = Product::findOrFail($id);
        $product['meta_value'] = ProductMetaValue::with('meta')
            ->where('product_id', $id)
            ->get();
        $product['brand'] = $product['name']->brand;
        return response()->json($product);
    }

    public function brands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function meta_keys()
    {
        $meta_keys = ProductMetaKey::all();
        return response()->json($meta_keys);
    }
}
