<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_th', 'name_en', 'tel', 'email', 'address_en', 'address_th',
    ];

    protected $appends = ['name', 'address'];

    public function getNameAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->name_th ? $this->name_th : $this->name_en;
        }
        return $this->name_en;
    }

    public function getAddressAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->address_th ? $this->address_th : $this->address_en;
        }
        return $this->address_en;
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
