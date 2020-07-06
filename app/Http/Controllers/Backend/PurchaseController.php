<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Supplier;
use App\Model\Unit;
use Auth;
use DB;

class PurchaseController extends Controller
{
    //view parchase method
    public function view ()
    {
        $alldata = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.purchase.view-purchase',compact('alldata'));
    }
    //add parchase interface method
    public function add()
    {
        $data['supplier'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['category'] = Categories::all();
        $data['date'] = date('Y-m-d');
        return view('backend.purchase.add-purchase',$data);
    }
    //store purchase method
    public function store(Request $request)
    {
        if($request->category_id == null){
            $notification=array(
                'message'=>'Nothing For Purchase!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }else{
            $count_category = count($request->category_id);
            for($i=0; $i < $count_category; $i++){
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d',strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->Product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $add_Purchase = $purchase->save();

            }

        }
        if($add_Purchase){
            $notification=array(
                'message'=>'Successfully Complete Purchase',
                'alert-type'=>'success'
            );
            return redirect()->route('pending.view.list')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('pending.view.list')->with($notification);
        }
    }
    //pending purchase method
    public function PendingList()
    {
        $alldata = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.purchase.view-pending',compact('alldata'));
    }
    //approve purchase method
    public function approve($id)
    {
        $purchase = Purchase::find($id);
        $product = Product::Where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')->where('id', $id)->update(['status'=>1]);
        }
        
        $notification=array(
            'message'=>'Successfully Approve Purchase',
            'alert-type'=>'success'
        );
        return redirect()->route('purchase.view')->with($notification);
       
    }
    //delete purchase method
    public function delete($id)
    {
        $Purchase = Purchase::find($id);
        $del = $Purchase->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Data',
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
