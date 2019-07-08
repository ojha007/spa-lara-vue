<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{


    protected $table = 'brands';

    public $timestamps = true;

    public $guarded = ['id'];
}
