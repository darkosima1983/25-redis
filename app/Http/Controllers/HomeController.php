<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $products = [];
        if(Cache::has('allProducts')){
            $products = Cache::get('allProducts');
        } else {
            $products = Products::latest()->take(9)->get();
            Cache::put('allProducts', $products, 300); // Cache for 5 minutes
        }
        return view('welcome', ['products' => $products]);
    }
}