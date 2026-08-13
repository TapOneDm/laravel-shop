<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::query();

        if ($request->has('category_id') && $request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->has('price_max') && $request->filled('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        if ($request->input('sort') === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->input('sort') === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->get();

        return view('catalog', [
            'products' => $products,
            'categories' => $categories,
            'currentFilters' => $request->all(),
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', ['product' => $product]);
    }
}
