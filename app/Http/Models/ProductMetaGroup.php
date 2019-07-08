<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMetaGroup extends Model{
    /**
     * @var string
     */
    protected $table = 'product_meta_groups';

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var array
     */

    public $guarded = ['id'];

    public function  metaKeys(){
        return $this->belongsToMany(ProductMetaKey::class);
    }
}
