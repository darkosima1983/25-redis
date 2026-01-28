<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
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


    public function saveProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Products::create($request->all());

        return redirect()->route('products.all')->with('success', 'Produkt erfolgreich hinzugefügt!');
    }
}
