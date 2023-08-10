<?php
declare(strict_types=1);

namespace App;

use App\Models\Income;
use App\Models\Order;
use App\Models\Sale;
use Illuminate\Support\Facades\Http;

class ServiceAPI
{
    protected string $param;

    public function __construct(string $param)
    {
        $this->param = $param;
    }

    public function callAPI(): void
    {
        $response = Http::get(env('FETCHED_SERVER_HOST_AND_PORT') . '/api/' . $this->param, [
            'key' => env('MY_ACCESS_TOKEN'),
            'dateFrom' => '2000-01-01',
            'dateTo' => date('Y-m-d')
        ]);
        $last_page = $response['meta']['last_page'];

        $data = [];
        $data[] = $response->json()['data'];

        for ($i = 1; $i <= $last_page; $i++) {
            $response = Http::retry(10, 5000)
                ->get(env('FETCHED_SERVER_HOST_AND_PORT') . '/api/' . $this->param, [
                    'key' => env('MY_ACCESS_TOKEN'),
                    'dateFrom' => '2000-01-01',
                    'dateTo' => date('Y-m-d')
                ]);

            if (isset($response) && isset($response->json()['data'])) {
                $data[] = $response->json()['data'];
            } else echo $i . PHP_EOL;
        }

        if ($this->param === 'sales') {

            self::saleCreate($data);
        }

        if ($this->param === 'orders') {
            self::orderCreate($data);
        }

        if ($this->param === 'incomes') {
            self::incomeCreate($data);
        }

    }

    static public function saleCreate(array $data): void
    {
        foreach ($data as $dataAr) {
            foreach ($dataAr as $itemAr) {
                Sale::create($itemAr);
            }
        }
    }

    static public function orderCreate(array $data): void
    {
        foreach ($data as $dataAr) {
            foreach ($dataAr as $itemAr) {
                Order::create($itemAr);
            }
        }
    }

    static public function incomeCreate(array $data): void
    {
        foreach ($data as $dataAr) {
            foreach ($dataAr as $itemAr) {
                Income::create($itemAr);
            }
        }
    }
}
