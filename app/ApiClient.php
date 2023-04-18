<?php declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function convertCurrency(float $amount): ?float
    {
        $url = 'https://www.latvijasbanka.lv/vk/ecb.xml';
        $response = $this->client->request('GET', $url);
        $data = simplexml_load_string($response->getBody()->getContents());

        $records = $data->result->records;

        if (!empty($records)) {
            $record = $records[0];
            return $record->usd->rate * $amount;
        }

        return null;
    }
}