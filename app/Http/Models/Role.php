<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'user_roles';
    protected $guarded = ['id'];
    protected $fillable = [
        'display_name',
    ];


}
