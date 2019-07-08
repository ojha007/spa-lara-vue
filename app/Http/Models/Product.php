<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $fillable = [
        'title',
        'content',
        'status',
        'slug',
        'status',
    ];
    public function productMetaValue()
    {
        return $this->hasMany(ProductMetaValue::class, 'product_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }


}
