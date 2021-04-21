<?php

namespace App\Helpers;

use App\Config;
use Illuminate\Support\Facades\Http;

class RefreshIgdbToken
{
    public static function refresh()
    {
        $igdbKey = Http::post(env('IGDB_REFRESH_TOKEN_URL'))->json()['access_token'];
        $config = Config::first();

        $config->igdb_key = $igdbKey;
        $config->save();
    }
}
