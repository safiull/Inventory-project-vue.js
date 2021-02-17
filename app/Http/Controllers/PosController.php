<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PosController extends Controller
{
    public function subProduct($id) 
    {
    	return response()->json(Product::where('category_id', $id)->get());
    }
}
