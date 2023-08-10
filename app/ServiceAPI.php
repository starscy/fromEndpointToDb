<?php
declare(strict_types=1);

namespace App;

use App\Models\Income;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ServiceAPI
{
    protected string $param;

    protected array $arParams = [];

    public function __construct(string $param)
    {
        $this->param = $param;

        if ($param === 'stocks') {
            $this->arParams = [
                'dateFrom' => date('Y-m-d'),
                'dateTo' => date('Y-m-d'),
            ];
        } else {
            $this->arParams = [
                'dateFrom' => '2000-01-01',
                'dateTo' => date('Y-m-d'),
            ];
        }
    }

    public function callAPI(): void
    {
        $data = $this->fetchDataWithCycle();

        switch ($this->param) {
            case 'sales':
                self::modelCreate(new Sale(), $data);
                break;
            case 'orders':
                self::modelCreate(new Order(), $data);
                break;
            case 'incomes':
                self::modelCreate(new Income(), $data);
                break;
            case 'stocks' :
                self::modelCreate(new Stock(), $data);
                break;
            default:
                break;
        }
    }

    protected function fetchDataWithCycle():array
    {
        $data = [];
        $response = $this->request($this->arParams);
        $last_page = $response['meta']['last_page'];

        for ($i = 1; $i <= $last_page; $i++) {
            $response = $this->request($this->arParams, $i);
            if (isset($response) && isset($response->json()['data'])) {
                $data[] = $response->json()['data'];
            } else echo 'error in ' . $i . PHP_EOL;
        }

        return $data;
    }

    protected function request(array $params, int $page = 1): Response
    {
        return Http::retry(10, 5000)->get(env('FETCHED_SERVER_HOST_AND_PORT') . '/api/' . $this->param, [
            'key' => env('MY_ACCESS_TOKEN'),
            'dateFrom' => $params['dateFrom'],
            'dateTo' => $params['dateTo'],
            'page' => $page,
        ]);
    }

    static public function modelCreate(Model $model, array $data): void
    {
        foreach ($data as $dataAr) {
            foreach ($dataAr as $itemAr) {
                $model::create($itemAr);
            }
        }
    }
}
