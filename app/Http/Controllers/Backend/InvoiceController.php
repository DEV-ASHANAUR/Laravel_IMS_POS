<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Supplier;
use App\Model\Unit;

use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customer;
use Auth;
use DB;
use PDF;

class InvoiceController extends Controller
{
    //view Invoice method
    public function view ()
    {
        $alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.view-invoice',compact('alldata'));
    }
    //add Invoice interface method
    public function add()
    {
        $data['category'] = Categories::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if($invoice_data == null){
            $firstReg = '0';
            $data['invoice_no']= $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
            $data['invoice_no']= $invoice_data+1;
        }
        $data['customer'] = Customer::all();
        $data['date'] = date('Y-m-d');
        return view('backend.invoice.add-invoice',$data);
    }
    //store Invoice method
    public function store(Request $request)
    {
        if($request->category_id == null){
            $notification=array(
                'message'=>'Nothing For Invoice!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }else{
            if($request->paid_amount > $request->estimated_amount){
                $notification=array(
                    'message'=>'Sorry! Paid Amount is Greater Then Total Amount.',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status  = '0';
                $invoice->created_by  = Auth::user()->id;
                DB::transaction(function () use($request,$invoice) {
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for($i=0; $i < $count_category; $i++){
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('y-m-d',strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->Product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '0';
                            $invoice_details->save();

                        }
                        if($request->customer_id == '0' ){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile;
                            $customer->address = $request->address;
                            $customer->created_by = Auth::user()->id;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }
                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if($payment->paid_status == 'full_paid'){
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount =$request->estimated_amount;
                        }elseif($payment->paid_status == 'full_due'){
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount ='0';
                        }elseif($payment->paid_status == 'partial_paid'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount-$request->paid_amount;
                            $payment_details->current_paid_amount =$request->paid_amount;
                        }
                        $payment->save(); 
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('y-m-d',strtotime($request->date));
                        $payment_details->save(); 

                    }
                });
            }

        } 
        $notification=array(
            'message'=>'Successfully Invoice Done.',
            'alert-type'=>'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);
        
    }
    //pending Invoice method
    public function PendingList()
    {
        $alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.invoice.view-pending-list',compact('alldata'));
    }
    //approve Invoice method
    public function approve($id)
    {
        $invoice = Invoice::with(['invoice_details'])->find($id);
        return view('backend.invoice.invoice-approve',compact('invoice'));
    }
    public function approval_store(Request $request,$id)
    {
        foreach($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                $notification=array(
                    'message'=>'Sorry! The Requested Product is Out of Stock!',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function () use($request,$invoice,$id) {
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        $notification=array(
            'message'=>'Successfully Approved Invoice!',
            'alert-type'=>'success'
        );
        return redirect()->route('invoice.view')->with($notification);
    }
    //delete Invoice method
    public function delete($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete(); 
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        
        $notification=array(
            'message'=>'Successfully Delete Invoice.',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function delete_approve($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete(); 
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        
        $notification=array(
            'message'=>'Successfully Cencle Invoice.',
            'alert-type'=>'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);
    }
    //print invoice method
    public function printInvoice($id) {
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Invoice.pdf');
    }
    //print daily invoice report
    public function dailyReport()
    {
        return view('backend.invoice.daily-invoice-report');
    }
    //daily report pdf genared
    public function dailyReportPdf(Request $request)
    {
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $data['alldata'] = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));

        $pdf = PDF::loadView('backend.pdf.daily-invoice-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('dailyInvoice.pdf');
    }
}
