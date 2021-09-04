<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id', 'desc')->paginate(5); 
        return \view('backend.products.index', compact('products'));
    }

    public function create(){
        return \view('backend.products.create');
    }
    public function store(Request $request){

            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'desc' => 'required',
                'photo' => 'required'
            ]);

            $photo = $request->file('photo');
            $newName = time() ."." .$photo->getClientOriginalExtension();
            $photo->move('upload/products', $newName);
            
            Product::create([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'desc'=>$request->input('desc'),
                'photo' => $newName
            ]);
    
            return \redirect()->route('admin.product');
    }
    public function edit($id){
        $product = Product::find($id);

        return \view("backend.products.edit", \compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required',
        ]);
        $product = Product::find($id);
        if ($request->hasFile('photo')) {

            if(file_exists('upload/products/'. $product->photo)){
                unlink('upload/products/'. $product->photo);
            }
            
            $photo = $request->file('photo');
            $newName = time() ."." .$photo->getClientOriginalExtension();
            $photo->move('upload/products', $newName);

            $newData = [
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'desc'=>$request->input('desc'),
                'photo' => $newName,
            ];

        }else {
            $newData = [
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'desc'=>$request->input('desc'),
            ];
        }
        $product->update($newData);
        
        return redirect()->route('admin.product');
    }

    public function delete($id){
        $product = Product::find($id);
        if(file_exists('upload/products/'. $product->photo)){
            unlink('upload/products/'. $product->photo);
        }
        $product->delete();
        return \redirect()->back();

    }
}
