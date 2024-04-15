<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class welcomeController extends Controller
{

    public function index()
    {
        $perPage = request()->input('perPage', 3); // По умолчанию показывать 3 элемента на странице
        $products = Product::paginate($perPage);
        return view('welcome', compact('products'));
    }
}
