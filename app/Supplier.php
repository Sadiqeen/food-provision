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
}
