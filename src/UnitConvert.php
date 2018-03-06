<?php namespace DevSquared\UnitConvert;

use GuzzleHttp\Client;
use DevSquared\UnitConvert\Contracts\UnitConvert as UnitConvertContract;

/**
 * Class UnitConvert
 * @package DevSquared\UnitConvert
 */
class UnitConvert implements UnitConvertContract
{
    protected $response;


    public function convert(string $from, string $to)
    {
        $client = self::getBaseUrl();
        $response = $client->request('GET', 'measurements/convert', [
            'query' => [
                'from' => $from,
                'to' => $to
            ]
        ]);
        $body = $response->getBody();
        $result = $body->getContents();
        $this->response = json_decode($result);

        return $this;
    }

    private function getBaseUrl()
    {
        $client = new Client([
            'base_uri' => 'https://api.unitconvert.io/api/v1/',
            'timeout' => 2.0,
            'headers' => [
                'api-key' => config('unitconvert.api_key')
            ]
        ]);

        return $client;
    }

    public function compare(string $first, string $comparison, string $second)
    {
        $client = self::getBaseUrl();
        $response = $client->request('GET', 'measurements/compare', [
            'query' => [
                'first' => $first,
                'second' => $second,
                'comparer' => $comparison
            ]
        ]);
        $body = $response->getBody();
        $result = $body->getContents();
        $this->response = json_decode($result);

        return $this;
    }

    public function getAmount()
    {
        return self::parseDecimalNotation($this->response->amount);
    }

    private function parseDecimalNotation($float)
    {
        $parts = explode('E', $float);

        if (count($parts) === 2) {
            $exp = abs(end($parts)) + strlen($parts[0]);
            $decimal = number_format($float, $exp);
            return rtrim($decimal, '.0');
        } else {
            return $float;
        }
    }

    public function getSuccess()
    {
        return $this->response->success;
    }

    public function getResult()
    {
        return $this->response->result;
    }

    public function getUnit()
    {
        return $this->response->unit;
    }

    public function getDisplay()
    {
        return $this->response->display;
    }
}