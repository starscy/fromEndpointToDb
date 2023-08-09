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
        $sales = new ServiceAPI('sales');

        $sales->callAPI();

    }
}
