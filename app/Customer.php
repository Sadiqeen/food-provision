<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_th',
        'coordinator_en',
        'coordinator_th',
        'tel',
        'email',
        'address_en',
        'address_th',
        'note',
    ];

    protected $appends = ['name', 'address', 'coordinator'];

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

    public function getCoordinatorAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->coordinator_th ? $this->coordinator_th : $this->coordinator_en;
        }
        return $this->coordinator_en;
    }
}
