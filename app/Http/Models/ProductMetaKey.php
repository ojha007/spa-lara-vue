<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMetaKey extends Model
{

    protected $table = "product_meta_keys";

    public $timestamps = true;
    public $guarded = ['id'];

    public function productMetaGroup()
    {
        return $this->belongsTo(ProductMetaGroup::class, 'group_id', 'id');
    }

}
