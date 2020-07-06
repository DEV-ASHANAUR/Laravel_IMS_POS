<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function payment()
    {
        return $this->belongsTo(Payment::class,'id','invoice_id');
    }
    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }
}
