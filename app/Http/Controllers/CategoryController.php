<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //load the controller
    protected $category;

    public function __construct(){
        $this->category = new Category();
    }

    public function index(){
        $response['categories'] = $this->category->all();
        return view('pages.index')->with($response);
    }

    public function store(Request $request){
        $this->category->create($request->all());
        return redirect()->back();
}
}