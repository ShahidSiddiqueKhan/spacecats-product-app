<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Events\ProductUpdated;

class ProductController extends Controller
{
   
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    
    public function fetchAndStore()
    {
        $response = Http::get('https://fakestoreapi.com/products');

        if (!$response->successful()) {
            Log::error('Failed to fetch products from Fake Store API', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }

        $products = $response->json();

        foreach ($products as $item) {
            
            $existing = Product::where('name', $item['title'])->first();
            if ($existing) {
                continue;
            }

            $product = Product::create([
                'name' => $item['title'],
                'description' => $item['description'],
                'price' => $item['price'],
            ]);

            broadcast(new ProductUpdated($product))->toOthers();
        }

        return response()->json(['status' => 'Products fetched and broadcasted']);
    }
}
