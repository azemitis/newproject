<?php declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;
use App\Models\Currency;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function convertCurrency(float $amount, string $toCurrency): float
    {
        $toCurrency = strtoupper($toCurrency);
        // Fetches the currency data from the XML file by calling the Guzzle fetch()
        $currencies = $this->fetch();
        /** @var Currency @curreny */

        // Gets the currency object based on the lowercase input currency
        $currency = $currencies[$toCurrency];

        if ($currency === null) {
            return 0;
        }

        return $amount * $currency->getRate();
    }

    private function fetch(): array
    {
        $url = 'https://www.latvijasbanka.lv/vk/ecb.xml';
        // Send a request using Guzzle HTTP client and get the response
        $response = $this->client->request('GET', $url);
        // Load the XML data into a simplexml object
        $records = simplexml_load_string($response->getBody()->getContents());

        $currencies = [];
        // XML data structure: Currencies->Currency
        foreach ($records->Currencies->Currency as $record) {
            $currencyName = (string)$record->ID;
            $currencyValue = (float)$record->Rate;
            // Create a Currency object with name and value, and add it to the $currencies array
            $currencies[$currencyName] = new Currency($currencyName, $currencyValue);
        }

        return $currencies;
    }
}
