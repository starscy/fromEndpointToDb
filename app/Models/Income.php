<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $guarded = ['id'];

    public $timestamps = false;

//    const CREATED_AT = 'create_time';
//    const UPDATED_AT = 'update_time';

}
