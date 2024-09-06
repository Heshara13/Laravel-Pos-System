<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    protected $brand;

    public function __construct(){
        $this->brand = new Brand();
    }
    public function index()
    {
        $response['brands'] = $this->brand->all();
        return view('brand.index')->with($response);
    }

    public function edit(string $id){
        $response['brand'] = $this->brand->find($id);
        return view('brand.edit')->with($response);
    }

    public function store(Request $request){
        $this->brand->create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, string $id){
        $brand = $this->brand->find($id);
        $brand->update(array_merge($brand->toArray(), $request->toArray()));
        return redirect('brand')->with('success', 'Brand updated successfully');
    }

    public function destroy(string $id){
        $this->brand->find($id)->delete();
        return redirect('brand')->with('success', 'Brand deleted successfully');
    }
}
