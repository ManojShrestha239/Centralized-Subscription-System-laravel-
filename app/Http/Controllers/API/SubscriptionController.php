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
                'error_code' => 'INVALID_API_KEY',
                'message' => 'The provided API key is invalid or does not correspond to an active client account. Please verify the key and try again.',
                'action_required' => 'Ensure the correct API key is provided or contact support if the issue persists.',
                'support_contact' => 'info@bihanitech.com'
            ], 401);
        }


        $currentDate = Carbon::now();
        if (Carbon::parse($client->subscription_expiry_date)->lt($currentDate)) {
            return response()->json(
                [
                    "status" => "expired",
                    "message" => "Your subscription expired on {$client->subscription_expiry_date}. Please renew your subscription to regain access to our services.",
                    "expiry_date" => "{$client->subscription_expiry_date}",
                    "action_required" => "Renewal"
                ],
                403
            );
        }

        return response()->json(
            [
                "status" => "success",
                "message" => "Your subscription is valid until {$client->subscription_expiry_date}. Please ensure to renew your subscription before the expiry date to maintain uninterrupted access to our services.",
                "expiry_date" => "{$client->subscription_expiry_date}",
                "action_required" => "Renewal"
            ],
            200
        );
    }
}
