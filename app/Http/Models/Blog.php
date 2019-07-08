<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $table = 'blogs';
    public $fillable =[
        'title',
        'content',
        'status',
        'slug',
        'status',
    ];



}
