<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait MakesApiRequests
{
    protected function getRequest($url)
    {
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
