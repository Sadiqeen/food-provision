<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_th',
        'price',
        'image',
        'desc',
        'supplier_id',
        'brand_id',
        'category_id',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
