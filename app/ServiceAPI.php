<?php
declare(strict_types=1);

namespace App;

use App\Models\Sale;
use Illuminate\Support\Facades\Http;

class ServiceAPI
{
    protected string $param;

    public function __construct(string $param)
    {
        $this->param = $param;
    }

    public function callAPI()
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

        self::parceJSON($data);

        return $response['data'];
    }

    static public function parceJSON(array $data)
    {
        foreach ($data as $dataAr) {

            foreach ($dataAr as $itemAr) {
                Sale::create([
                    "g_number" => $itemAr["g_number"],
                    "date" => $itemAr["date"],
                    "last_change_date" => $itemAr["last_change_date"],
                    "supplier_article" => $itemAr["supplier_article"],
                    "tech_size" => $itemAr["tech_size"],
                    "barcode" => $itemAr["barcode"],
                    "total_price" => $itemAr['total_price'],
                    "discount_percent" => $itemAr['discount_percent'],
                    "is_supply" => $itemAr['is_supply'],
                    "is_realization" => $itemAr['is_realization'],
                    "promo_code_discount" => $itemAr['promo_code_discount'],
                    "warehouse_name" => $itemAr["warehouse_name"],
                    "country_name" => $itemAr["country_name"],
                    "oblast_okrug_name" => $itemAr["oblast_okrug_name"],
                    "region_name" => $itemAr["region_name"],
                    "income_id" => $itemAr['income_id'],
                    "sale_id" => $itemAr["sale_id"],
                    "odid" => $itemAr['odid'],
                    "spp" => $itemAr['spp'],
                    "for_pay" => $itemAr['for_pay'],
                    "finished_price" => $itemAr['finished_price'],
                    "price_with_disc" => $itemAr['price_with_disc'],
                    "nm_id" => $itemAr['nm_id'],
                    "subject" => $itemAr["subject"],
                    "category" => $itemAr["category"],
                    "brand" => $itemAr["brand"],
                    "is_storno" => $itemAr['is_storno'],
                ]);
            }
        }
    }
}
