<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $guarded = ['id'];

    public $timestamps = false;

//    const CREATED_AT = 'create_time';
//    const UPDATED_AT = 'update_time';

}
