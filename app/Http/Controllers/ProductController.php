<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = new Product();
    }
    
    public function index()
    {
        $products = $this->product->all();
        $categories = Category::pluck('catname', 'id');
        $brands = Brand::pluck('brandname', 'id');
        return view('product.index', compact('products', 'categories', 'brands'));
    }

    
    public function store(Request $request){
        $this->product->create($request->all());
        return redirect()->back();
    }

    
}
