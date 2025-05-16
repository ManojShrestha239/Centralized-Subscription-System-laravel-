<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function checkSubscription(Request $request)
    {
        $request->validate([
            'api_key' => 'required|string',
        ]);

        $client = Client::where('api_key', $request->api_key)->first();

        if (!$client) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key'
            ], 401);
        }

        $currentDate = Carbon::now();
        if (Carbon::parse($client->expiry_date)->lt($currentDate)) {
            return response()->json([
                'status' => 'expired',
                'message' => 'Subscription has expired'
            ], 403);
        }

        return response()->json([
            'status' => 'available',
            'message' => 'Subscription is active'
        ], 200);
    }
}
