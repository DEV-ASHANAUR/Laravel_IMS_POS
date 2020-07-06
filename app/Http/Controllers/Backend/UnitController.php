<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Unit;
use Auth;
class UnitController extends Controller
{
    //view unit method
    public function view ()
    {
        $unitdata = Unit::all();
        return view('backend.unit.view-unit',compact('unitdata'));
    }
    //add unit interface method
    public function add()
    {
        return view('backend.unit.add-unit');
    }
    //store unit method
    public function store(Request $request)
    {
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->created_by = Auth::user()->id;
        $add_unit = $unit->save();
        if($add_unit){
            $notification=array(
                'message'=>'Successfully Add Unit',
                'alert-type'=>'success'
            );
            return redirect()->route('units.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('units.view')->with($notification);
        }
    }
    //edit unit method
    public function edit($id)
    {
        $editData = Unit::find($id);
        return view('backend.unit.edit-unit',compact('editData'));
    }
    //update unit method
    public function update (Request $request,$id)
    {
        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->updated_by = Auth::user()->id;
        $unit_update = $unit->save();
        if($unit_update){
            $notification=array(
                'message'=>'Successfully Update Unit',
                'alert-type'=>'success'
            );
            return redirect()->route('units.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('units.view')->with($notification);
        }
    }
    //delete unit method
    public function delete($id)
    {
        $Unit = Unit::find($id);
        $del = $Unit->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Unit',
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
