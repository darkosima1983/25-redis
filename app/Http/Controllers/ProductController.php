<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Support\Facades\Cache;
class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Products::all();
        return view('products.all', compact('products'));
    }
    public function createProduct()
    {
        return view('products.add');
    }


    public function saveProduct(CreateProductRequest $request)
    {
        Products::create($request->validated());

        Cache::forget('allProducts');

        return redirect()->route('products.all')->with('success', 'Produkt erfolgreich hinzugefügt!');
    }

    public function flushCache()
    {
        Cache::forget('allProducts');

        return redirect()->back()->with('success', 'Redis cache je obrisan.');
    }
}
