<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Supplier;
use App\Model\Unit;
use Auth;

class ProductController extends Controller
{
    //view product method
    public function view ()
    {
        $alldata = Product::all();
        return view('backend.product.view-product',compact('alldata'));
    }
    //add product interface method
    public function add()
    {
        $data['supplier'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['category'] = Categories::all();
        return view('backend.product.add-product',$data);
    }
    //store product method
    public function store(Request $request)
    {
        $product = new Product();
        $product->supplier_id = $request->supplier_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->quantity = '0';
        $product->created_by = Auth::user()->id;
        $add_product = $product->save();
        if($add_product){
            $notification=array(
                'message'=>'Successfully Add Product',
                'alert-type'=>'success'
            );
            return redirect()->route('products.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('products.view')->with($notification);
        }
    }
    //edit product method
    public function edit($id)
    {  
        $data['editData'] = Product::find($id); 
        $data['supplier'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['category'] = Categories::all();
        return view('backend.product.edit-product',$data);
    }
    //update product method
    public function update (Request $request,$id)
    {
        $product =Product::find($id);
        $product->supplier_id = $request->supplier_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->updated_by = Auth::user()->id;
        $up_product = $product->save();
        if($up_product){
            $notification=array(
                'message'=>'Successfully Update Product',
                'alert-type'=>'success'
            );
            return redirect()->route('products.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('products.view')->with($notification);
        }
    }
    //delete product method
    public function delete($id)
    {
        $product = Product::find($id);
        $del = $product->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Product',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->back()->with($notification);
        }
    }
}
