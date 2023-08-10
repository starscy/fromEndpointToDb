<?php

namespace App\Console\Commands;

use App\ServiceAPI;
use Illuminate\Console\Command;

class ParseSales extends Command
{
    protected $signature = 'api:parse';

    protected $description = 'Парсер продаж, заказов, акций и доходов';

    public function handle()
    {
        //ServiceAPI::callAPI();
      //  $sales = new ServiceAPI('sales');
       // $sales = new ServiceAPI('orders');

       // $parserArr = ['incomes'];

        $parserArr = ['stocks'];

        foreach ($parserArr as $tableName) {
            $service = new ServiceAPI($tableName);
            $service->callAPI();
        }
    }
}
