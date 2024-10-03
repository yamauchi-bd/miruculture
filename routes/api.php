<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/company-search', function (Request $request) {
    $query = $request->input('query');
    $apiUrl = "https://info.gbiz.go.jp/hojin/v1/hojin?name=" . urlencode($query);

    $response = Http::withHeaders([
        'X-hojinInfo-api-token' => config('services.gbizinfo.api_key'),
    ])->get($apiUrl);

    return $response->json();
});