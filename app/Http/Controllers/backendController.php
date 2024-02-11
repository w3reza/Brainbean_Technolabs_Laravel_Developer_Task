<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class backendController extends Controller
{
   public function index()
   {
    $products = Product::orderBy('id', 'desc')->get();
    return view('backend.pages.home', compact('products'));
   }

}
