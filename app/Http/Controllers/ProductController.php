<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
  
    public function create()
    {
        return view('welcome');
    }

 
    public function store(Request $request)
    {
        // Log the incoming request data for debugging
        // \Log::info('Incoming request data:', $request->all());
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'product' => 'required|array',
            'otherFruitName' => 'nullable|string|max:255',
            'applePrice' => 'nullable|numeric',
            'orangePrice' => 'nullable|numeric',
            'tomatoPrice' => 'nullable|numeric',
            'otherFruitPrice' => 'nullable|numeric',
        ]);
    
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->phone = $validatedData['phone'];
        $product->email = $validatedData['email'];
        $product->selected_products = $validatedData['product'];
        $product->apple_price = $request->input('applePrice');
        $product->orange_price = $request->input('orangePrice');
        $product->tomato_price = $request->input('tomatoPrice');
        $product->other_fruit_name = $request->input('otherFruitName');
        $product->other_fruit_price = $request->input('otherFruitPrice');
    
        // Log the product data before saving
        \Log::info('Product data before saving:', $product->toArray());
    
        $product->save();
    
        return redirect()->back()->with('success', 'تم حفظ المنتج بنجاح!');
    }
}
