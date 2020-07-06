<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Payment;
use App\Model\PaymentDetail;
use Auth;
use PDF;

class CustomerController extends Controller
{
    //view customer method
    public function view ()
    {
        $alldate = Customer::all();
        return view('backend.customer.view-customer',compact('alldate'));
    }
    //add customer interface method
    public function add()
    {
        return view('backend.customer.add-customer');
    }
    //store customer method
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile;
        $customer->address = $request->address;
        $customer->created_by = Auth::user()->id;
        $created = $customer->save();
        if($created){
            $notification=array(
                'message'=>'Successfully Add Customer.',
                'alert-type'=>'success'
            );
            return redirect()->route('customers.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('customers.view')->with($notification);
        }
    }
    //edit customer method
    public function edit($id)
    {
        $editData = Customer::find($id);
        return view('backend.customer.edit-customer',compact('editData'));
    }
    //update customer method
    public function update (Request $request,$id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile;
        $customer->address = $request->address;
        $customer->updated_by = Auth::user()->id;
        $created = $customer->save();
        if($created){
            $notification=array(
                'message'=>'Successfully Update Customer',
                'alert-type'=>'success'
            );
            return redirect()->route('customers.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went worng!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->route('customers.view')->with($notification);
        }
    }
    //delete customer method
    public function delete($id)
    {
        $customer = Customer::find($id);
        $del = $customer->delete(); 
        if($del){
            $notification=array(
                'message'=>'Successfully Delete Customer',
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
    //view credit cutomer
    public function creditCustomer()
    {
        $alldate = Payment::whereIn('paid_status',['partial_paid','full_due'])->get();
        return view('backend.customer.credit-customer',compact('alldate'));
    }
    public function creditCustomerpdf()
    {
        $data['alldata'] = Payment::whereIn('paid_status',['partial_paid','full_due'])->get();
        $pdf = PDF::loadView('backend.pdf.credit-customer-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('CreditCustomer.pdf');
    }
    //edit invoice method
    public function editinvoice($invoice_id)
    {
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $data['date'] = date('Y-m-d');
        return view('backend.customer.edit-invoice',$data);
    }
    //update invoice method
    public function updateinvoice(Request $request,$invoice_id)
    {
        if($request->new_paid_amount < $request->paid_amount){
            $notification=array(
                'message'=>'Sorry! Paid Amount is Greater Then Due Amount!',
                'alert-type'=>'error'
            );
            //return Redirect()->back()->with($notification);
            return redirect()->back()->with($notification);
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }elseif($request->paid_status == 'partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount'] - $request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date)) ;
            $payment_details->save();
            $notification=array(
                'message'=>'Successfully Update Invoice!',
                'alert-type'=>'success'
            );
            return redirect()->route('customers.paid')->with($notification);

        }
    }
    //invoice details invoice method
    public function detailsInvoice($invoice_id)
    {
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $pdf = PDF::loadView('backend.pdf.invoice-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Details_invoice.pdf');
    }
    //paid customer list
    public function paidCustomer()
    {
        $alldate = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.customer.paid-customer',compact('alldate'));
    }
    public function paidCustomerpdf()
    {
        $data['alldata'] = Payment::where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('backend.pdf.paid-customer-pdf', $data); 
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('PaidCustomer.pdf');
    }

}
