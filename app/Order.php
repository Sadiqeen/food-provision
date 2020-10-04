<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function product() {
        return $this->belongsToMany('App\Product', 'order_has_product')->withPivot('quantity');
    }

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function status() {
        return $this->belongsTo('App\Status');
    }

}
