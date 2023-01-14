<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function index(){

        $product = Product::latest()->paginate(6);

        return view('index',compact('product'));
    }
}
