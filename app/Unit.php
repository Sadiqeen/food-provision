<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_th', 'name_en',
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->name_th ? $this->name_th : $this->name_en;
        }
        return $this->name_en;
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
