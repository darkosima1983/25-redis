<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
       /* $products = [];
        if(Cache::has('allProducts')){
            $products = Cache::get('allProducts');
        } else {
            $products = Products::latest()->take(9)->get();
            Cache::put('allProducts', $products, 300); // Cache for 5 minutes
        }   prvi nacin najduzi*/
        /*$products =Cache::remember('allProducts', 300, function() {
            return Products::latest()->take(9)->get();
        });*/ // drugi nacin kraci

        $products =Cache::remember('allProducts', 300, fn() => Products::latest()->take(9)->get());
        
        return view('welcome', ['products' => $products]);
    }
}