<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Supplier;
use App\Model\Unit;
use Auth;
use PDF;

class StockController extends Controller
{
    //view product method
    public function StockReport ()
    {
        $alldata = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.stock.stock-report',compact('alldata'));
    }
    //add product interface method
    public function StockReportpdf()
    {
        $data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        $pdf = PDF::loadView('backend.pdf.stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('StockInvoice.pdf');
    }
}
