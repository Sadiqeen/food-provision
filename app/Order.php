<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = ['order_number', 'quotation_number', 'do_number', 'invoice_number'];

    public function getOrderNumberAttribute()
    {
        return  'OD-' . str_pad($this->id, 3, '0', STR_PAD_LEFT) . '-' . str_pad($this->customer_id, 3, '0', STR_PAD_LEFT);
    }

    public function getQuotationNumberAttribute()
    {
        return  'QFN' . str_pad($this->id, 3, '0', STR_PAD_LEFT) . str_pad($this->customer_id, 3, '0', STR_PAD_LEFT);
    }

    public function getDoNumberAttribute()
    {
        return  'FNDO' . str_pad($this->id, 3, '0', STR_PAD_LEFT) . str_pad($this->customer_id, 3, '0', STR_PAD_LEFT);
    }

    public function getInvoiceNumberAttribute()
    {
        return  'FN' . str_pad($this->id, 3, '0', STR_PAD_LEFT) . str_pad($this->customer_id, 3, '0', STR_PAD_LEFT);
    }

    public function product() {
        return $this->belongsToMany('App\Product', 'order_has_product')->withPivot(['quantity', 'price'])->withTimestamps();
    }

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function status() {
        return $this->belongsTo('App\Status');
    }

    public function statusDate() {
        return $this->belongsToMany('App\Status', 'order_has_status')->withTimestamps();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
