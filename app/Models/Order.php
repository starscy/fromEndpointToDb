<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        "g_number",
        "date",
        "last_change_date",
        "supplier_article",
        "tech_size",
        "barcode",
        "total_price",
        "discount_percent",
        "warehouse_name",
        "oblast",
        "income_id",
        "odid",
        "nm_id",
        "subject",
        "category",
        "brand",
        "is_cancel",
        "cancel_dt",
    ];

    public $timestamps = false;

//    const CREATED_AT = 'create_time';
//    const UPDATED_AT = 'update_time';

}
