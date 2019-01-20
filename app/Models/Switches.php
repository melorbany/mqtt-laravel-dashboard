<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Switches extends Model
{
    protected $table = 'switches';

    protected $fillable = [
        'id','unit_id','title','modbus','type','buttons', 'details','user_id'
    ];

    public $incrementing = false;

}
