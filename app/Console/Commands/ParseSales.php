<?php

namespace App\Console\Commands;

use App\ServiceAPI;
use Illuminate\Console\Command;

class ParseSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:parse';

    protected $description = 'Парсер продаж';


    public function handle()
    {
        //ServiceAPI::callAPI();
      //  $sales = new ServiceAPI('sales');
       // $sales = new ServiceAPI('orders');

        $parserArr = ['incomes'];

        foreach ($parserArr as $tableName) {
            $service = new ServiceAPI($tableName);
            $service->callAPI();
        }

//        $sales = new ServiceAPI('orders');
//
//        $sales->callAPI();

    }
}
