<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Product
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_th
 * @property int $price
 * @property string|null $image
 * @property string|null $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $supplier_id
 * @property int $brand_id
 * @property int $category_id
 * @property int $unit_id
 * @property-read \App\Brand $brand
 * @property-read \App\Category $category
 * @property-read \App\Supplier $supplier
 * @property-read \App\Unit $unit
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNameTh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'vat',
        'supplier_id',
        'brand_id',
        'category_id',
        'unit_id',
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (app()->getLocale() == "th") {
            return $this->name_th ? $this->name_th : $this->name_en;
        }
        return $this->name_en;
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

    public function order() {
        return $this->belongsToMany('App\Order', 'order_has_product')->withPivot(['quantity', 'price']);
    }

}
