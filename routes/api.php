<?php

use App\Http\Controllers\DomainName\IndexController as DomainNameIndexController;
use App\Http\Controllers\User\IndexController as UserIndexController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserIndexController::class);
Route::apiResource('domainNames', DomainNameIndexController::class)
    ->except(['update']);
