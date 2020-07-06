<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paid-Customer</title> 
</head>
<body>
    <h3 style="color: red"><span>Nur's Brother's Ltd</span></h3>
    <hr style="color: red">
        <h3 style="margin:0;padding:0;text-align:center">Paid Customer Report</h3>
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
    <h4 style="color: red;">Paid Summary</h4>   
    <table style="width: 100%; margin-bottom:100px">
        <thead>
            <tr style="background: red;">
                <th style=" color:white">SL</th>
                <th style=" color:white">Customer Name</th>
                <th style=" color:white">Invoice</th>
                <th style=" color:white">Date</th>
                <th style=" color:white">Paid Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_paid = '0';
            @endphp
            @foreach ($alldata as $key => $payment)
                <tr>
                    <th style="border: 1px solid red;">{{ $key+1 }}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ $payment['customer']['name'] }}
                        ({{ $payment['customer']['mobile_no'] }})</th>
                    <th style="border: 1px solid red;padding:7px;">#{{ $payment['invoice']['invoice_no']}}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ date('d-M-Y',strtotime($payment['invoice']['date']))}}</th>
                    <th style="border: 1px solid red;padding:7px;">{{ number_format($payment->paid_amount,2).' tk' }}</th>
                     @php
                        $total_paid += $payment->paid_amount;   
                     @endphp   
                </tr>
            @endforeach
        </tbody>
        <thead>
            <tr style="background: red;">
                <th style=" color:white">SL</th>
                <th style=" color:white">Customer Name</th>
                <th style=" color:white">Invoice</th>
                <th style=" color:white">Date</th>
                <th style=" color:white">Paid Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="4" style="text-align: right;padding:8px;background: red;color:white">Total Paid Amount:</th>
                <th style="border: 1px solid red;"><strong>{{ number_format($total_paid,2)." Tk" }}</strong></th>
            </tr>
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