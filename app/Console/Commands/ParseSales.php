<?php

namespace App\Console\Commands;

use App\ServiceAPI;
use Illuminate\Console\Command;

class ParseSales extends Command
{
    protected $signature = 'api:parse';

    protected $description = 'Парсер продаж, заказов, акций и доходов';

    public function handle():void
    {
        $parseNamesArr = [
            'stocks',
            'incomes',
            'sales',
            'orders',
        ];

        foreach ($parseNamesArr as $tableName) {
            $service = new ServiceAPI($tableName);
            $service->callAPI();
        }
    }
}
