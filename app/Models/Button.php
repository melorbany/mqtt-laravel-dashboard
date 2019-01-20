<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    protected $table = 'buttons';

    protected $fillable = [
        'id','switch_id','title','register','user_id'
    ];

}
