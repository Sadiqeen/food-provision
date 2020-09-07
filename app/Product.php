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
        'name_th',
        'name_en',
        'price',
        'image',
        'desc_en',
        'desc_th',
        'supplier_id',
        'brand_id',
        'category_id',
        'unit_id',
    ];

    protected $appends = ['name', 'desc'];

    public function getNameAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->name_th ? $this->name_th : $this->name_en;
        }
        return $this->name_en;
    }

    public function getDescAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->desc_th ? $this->desc_th : $this->desc_en;
        }
        return $this->desc_en;
    }

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
