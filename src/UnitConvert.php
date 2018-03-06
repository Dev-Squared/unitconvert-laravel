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

    public function getMeasurementInfo(string $measurement)
    {
        $client = self::getBaseUrl();
        $response = $client->request('GET', 'measurements/info', [
            'query' => [
                'measurement' => $measurement
            ]
        ]);
        $body = $response->getBody();
        $result = $body->getContents();
        $this->response = json_decode($result);

        return $this;
    }

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
        return isset($this->response->amount) ? self::parseDecimalNotation($this->response->amount) : null;
    }

    public function getSuccess()
    {
        return $this->response->success;
    }

    public function getResult()
    {
        return isset($this->response->result) ? $this->response->result : '';
    }

    public function getUnit()
    {
        return isset($this->response->unit) ? $this->response->unit : '';
    }

    public function getDisplay()
    {
        return isset($this->response->display) ? $this->response->display : '';
    }

    public function getCategory()
    {
        return isset($this->response->category) ? $this->response->category : '';
    }

    public function getVariants()
    {
        return isset($this->response->variants) ? $this->response->variants : [];
    }

    public function getConvertableTo()
    {
        return isset($this->response->convertableTo) ? $this->response->convertableTo : [];
    }

    public function getError()
    {
        return isset($this->response->error) ? $this->response->error : null;
    }

    private function getBaseUrl()
    {
        $client = new Client([
            'base_uri' => 'https://api.unitconvert.io/api/v1/',
            'headers' => [
                'api-key' => config('unitconvert.api_key')
            ],
            'http_errors' => false
        ]);

        return $client;
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
}