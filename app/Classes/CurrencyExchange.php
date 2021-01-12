<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class CurrencyExchange
{

    const API_KEY = 'cfcffb18e823a2be6eb9';

    public function __construct()
    {
        return "construct function was initialized.";
    }

    public function create($currency_response)
    {
        $arr_currency_response = $this->getCurrenciesFromQuestion($currency_response);
        if ($arr_currency_response['completed'] == false) {
            $message = $arr_currency_response['message'];
            return [
                'value' => $message,
                'completed' => false
            ];
        }
        $params = $arr_currency_response['data'];
        $amount = $params['amount'];
        $from_currency = $params['from_currency'];
        $to_currency = $params['to_currency'];
        $query = "{$from_currency}_{$to_currency}";
        $response = Http::get('https://free.currconv.com/api/v7/convert', [
            'q' => $query,
            'compact' => 'ultra',
            'apiKey' => self::API_KEY,
        ]);
        // print_r($response);
        // die;
        try {
            $decoded = json_decode($response, true);
            $val = floatval($decoded["$query"]);
            $value_converted = $val * $amount;
            return [
                'value' => number_format($value_converted, 2, '.', ''),
                'to_currency' => $to_currency,
                'completed' => true
            ];
        } catch (\Throwable $th) {
            return [
                'value' => 'I\'m trying but I couldn\'t',
                'completed' => false
            ];
        }
    }

    public function getCurrenciesFromQuestion($str_resp_currency)
    {
        $arr_cur = explode(" ", $str_resp_currency);
        // Format Validations
        if (count($arr_cur) != 4) {
            return [
                'completed' => false,
                'message' => 'I couldn\'t understand that format'
            ];
        } else {
            return [
                'completed' => true,
                'message' => 'Process completed',
                'data' => [
                    'amount' => $arr_cur[0],
                    'from_currency' => strtoupper($arr_cur[1]),
                    'to_currency' => strtoupper($arr_cur[3])
                ]
            ];
        }
    }
}
