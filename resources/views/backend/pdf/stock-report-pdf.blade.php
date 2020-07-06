<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice-Pos</title> 
</head>
<body>
    <h3 style="color: red"><span>Nur's Brother's Ltd</span></h3>
    <hr style="color: red">
        <h3 style="margin:0;padding:0;text-align:center">Product Stock Report</h3>
    <hr style="color: red">
    {{-- @php
        $payment = App\model\Payment::where('invoice_id',$invoice->id)->first();
    @endphp
    <div>
        <strong>Shipped To:</strong><br>
        {{ $payment['customer']['name'] }}<br>
        {{ $payment['customer']['address'] }}<br>
        {{ ($payment['customer']['email'])?$payment['customer']['email']:'Example@gmail.com' }}<br>
        {{ $payment['customer']['mobile_no'] }} <br>
        <strong>Invoice Date:</strong><br>
          {{ date('d-M-Y',strtotime($invoice->date)) }}<br>
    </div>    --}}
    <h4 style="color: red;">Order Summary</h4>   
    <table style="width: 100%; margin-bottom:100px">
        <thead>
            <tr style="background: red;">
                <th style=" color:white">SL</th>
                <th style=" color:white">Supplier Name</th>
                <th style=" color:white">Category</th>
                <th style=" color:white">Product Name</th>
                <th style=" color:white">In_Qty</th>
                <th style=" color:white">Out_Qty</th>
                <th style=" color:white">Current Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alldata as $key => $product)
            @php
                $buying_qty = App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                $selling_qty = App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
            @endphp
                <tr>
                    <th style="border: 1px solid red;">{{ $key+1 }}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ $product['supplier']['name'] }}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ $product['category']['name'] }}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ $product->name }}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ $buying_qty }}
                        {{ $product['unit']['name'] }}</th>
                        <th style="border: 1px solid red;padding:7px;">{{ $selling_qty }}
                            {{ $product['unit']['name'] }}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ $product->quantity }}
                        {{ $product['unit']['name'] }}</th>
                </tr>
            @endforeach
        </tbody>
        <thead>
            <tr style="background: red;">
                <th style=" color:white">SL</th>
                <th style=" color:white">Supplier Name</th>
                <th style=" color:white">Category</th>
                <th style=" color:white">Product Name</th>
                <th style=" color:white">In_Qty</th>
                <th style=" color:white">Out_Qty</th>
                <th style=" color:white">Current Stock</th>
            </tr>
        </thead>
        <tbody>
            @php
                $date = new DateTime('now',new DateTimezone('Asia/Dhaka'));
            @endphp
            <tr>
                <th colspan="4" style="text-align:left;margin-top:8px">printing Date : {{ $date->format('F j, Y, g:i a') }}</th>
            </tr>
            
        </tbody>
    </table>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th colspan="4" style="text-align: left;border-top:2px solid red;padding-top:5px">Owner Signature</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="4" style="text-align: left">Nur's Brother's Ltd</th>
            </tr>
            <tr>
                <th colspan="8" style="text-align: left">Mobile : 01866936562</th>
            </tr>
            <tr>
                <th colspan="8" style="text-align: left">Address : Dhaka,Bangladesh</th>
            </tr>
            
        </tbody>
    </table>
    
      
</body>
</html>