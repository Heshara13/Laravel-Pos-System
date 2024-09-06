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
        return view('category.index')->with($response);
    }

    public function store(Request $request){
    $data = $request->all();
    $data['catname'] = $data['catname'] ?? 'Default Category Name';

    $this->category->create($data);

    return redirect()->back();
    }

    public function edit(string $id){
        $response['category'] = $this->category->find($id);
        return view('category.edit')->with($response);
    }

    public function update(Request $request, string $id){
        $category = $this->category->find($id);
        $category->update(array_merge($category->toArray(), $request->toArray()));
        return redirect('category')->with('success', 'Category updated successfully');
    }

    public function destroy(string $id){
        $this->category->find($id)->delete();
        return redirect('category')->with('success', 'Category deleted successfully');
    }
}