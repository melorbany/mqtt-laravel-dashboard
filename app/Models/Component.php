<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'components';

    protected $fillable = [
        'id','unit_id','title','type', 'details','user_id'
    ];

    public $incrementing = false;
}
