<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;


class ProductMetaValue extends Model
{
    protected $table = 'product_meta_values';
    public $timestamps = true;
    public $guarded = ['id'];

    public function meta()
    {
        return $this->belongsTo(ProductMetaKey::class, 'meta_key_id', 'id');
    }

}
