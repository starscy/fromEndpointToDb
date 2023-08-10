<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $fillable = [
        "income_id",
        "number",
        "date",
        "last_change_date",
        "supplier_article",
        "tech_size",
        "barcode",
        "quantity",
        "total_price",
        "date_close",
        "warehouse_name",
        "nm_id",
        "status"
    ];

    public $timestamps = false;

//    const CREATED_AT = 'create_time';
//    const UPDATED_AT = 'update_time';

}
