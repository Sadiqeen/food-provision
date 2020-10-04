<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->status_th ? $this->status_th : $this->status_en;
        }
        return $this->status_en;
    }

    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
