<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class CustomResponse
{
    public function __construct()
    {
        return "construct function was initialized.";
    }

    public static function do($validated, $message, $data = [])
    {
        return [
            'ok' => $validated,
            'message' => $message,
            'data' => $data,
        ];
    }
}
