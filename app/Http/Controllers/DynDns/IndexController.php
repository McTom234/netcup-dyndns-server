<?php

namespace App\Http\Controllers\DynDns;

use App\Http\Controllers\Controller;
use App\Http\Requests\DynDns\UpdateRequest;
use App\Services\Netcup\ApiService;
use Illuminate\Support\Arr;

class IndexController extends Controller
{
    public function __invoke(UpdateRequest $request, ApiService $apiService)
    {
        $hostnames = Arr::map(
            preg_split(',', $request->query('hostname')),
            static fn (string $hostname) => trim($hostname),
        );
        $ip = $request->query('myip');


    }

}
