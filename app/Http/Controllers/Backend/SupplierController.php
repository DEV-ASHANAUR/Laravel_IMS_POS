<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use Auth;

class SupplierController extends Controller
{
    //view suppliers method
    public function view ()
    {
        $suppdata = Supplier::all();
        return view('backend.supplier.view-supplier',compact('suppdata'));
    }
    //add suppliers interface method
    public function add()
    {
        return view('backend.supplier.add-supplier');
    }
    //store supplier method
    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile_no = $request->mobile;
        $supplier->address = $request->address;
        $supplier->created_by = Auth::user()->id;
        $created = $supplier->save();
        if($created){
            $notification=array(
                'message'=>'Successfully Add Supplier',
                'alert-type'=>'success'
            );
            return redirect()->route('suppliers.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('suppliers.view')->with($notification);
        }
    }
    //edit suppliyer method
    public function edit($id)
    {
        $editData = Supplier::find($id);
        return view('backend.supplier.edit-supplier',compact('editData'));
    }
    //update supplier method
    public function update (Request $request,$id)
    {
        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile_no = $request->mobile;
        $supplier->address = $request->address;
        $supplier->updated_by = Auth::user()->id;
        $created = $supplier->save();
        if($created){
            $notification=array(
                'message'=>'Successfully Update Supplier',
                'alert-type'=>'success'
            );
            return redirect()->route('suppliers.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('suppliers.view')->with($notification);
        }
    }
    //delete supplier method
    public function delete($id)
    {
        $supplier = Supplier::find($id);
        $del = $supplier->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Supplier',
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
