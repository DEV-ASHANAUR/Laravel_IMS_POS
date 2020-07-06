<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Supplier;
use App\Model\Unit;
use Auth;
class DefaultController extends Controller
{
    //throw supplier id get category
    public function getCategory(Request $request)
    {
        $supplier_id = $request->supplier_id;
        // dd($supplier_id);
        $allcategory  = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        // dd($allcategory->toArray());
        return response()->json($allcategory);
    }
    //throw category id get product
    public function getProduct(Request $request)
    {
        $category_id = $request->category_id;
        $allproduct  = Product::where('category_id',$category_id)->get();
        return response()->json($allproduct);
    }
    public function getStock(Request $request){
        $product_id = $request->Product_id;
        $stock = Product::with(['purchase'])->where('id',$product_id)->get();
        //dd($stock);
        return response()->json($stock);
    }

}
