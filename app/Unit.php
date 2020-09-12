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
        'name',
    ];

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
