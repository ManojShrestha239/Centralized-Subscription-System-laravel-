<?php

use Illuminate\Support\Facades\Route;

Route::post('/check-subscription', [\App\Http\Controllers\API\SubscriptionController::class, 'checkSubscription'])
    ->name('api.check-subscription');
