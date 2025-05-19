<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function checkSubscription(Request $request)
    {
        $request->validate([
            'domain' => 'required|string|max:255',
            'timestamp' => 'required|numeric'
        ]);

        $nonce = $request->header('X-API-Nonce');
        $signature = $request->header('X-API-Signature');

        if (abs(time() - $request->timestamp) > 300) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid request timestamp'
            ], 401);
        }

        $client = Client::where('domain', $request->domain)->first();

        if (!$client) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid request Client'
            ], 401);
        }

        if ($request->domain !== $request->header('X-API-Domain')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid request domain'
            ], 401);
        }

        if (!$client || !$this->verifySignature($request, $client, $nonce)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Signature verification failed'
            ], 401);
        }

        $expiryDate = Carbon::parse($client->subscription_expiry_date);

        $response = [
            'status' => $expiryDate->isFuture() ? 'active' : 'expired',
            'expiry_date' => $client->subscription_expiry_date
        ];

        if ($response['status'] === 'expired') {
            return response()->json([
                'status' => 'expired',
                'message' => 'Subscription expired',
                'redirect_url' => 'https://bihanitech.com/subscription-expired'
            ])->withHeaders([
                'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'DENY',
                'Content-Security-Policy' => "default-src 'self'"
            ]);
        }

        return response()->json($response)->withHeaders([
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'Content-Security-Policy' => "default-src 'self'"
        ]);
    }

    private function verifySignature($request, $client, $nonce)
    {
        $computed = hash_hmac(
            'sha256',
            $request->timestamp . $request->domain . $nonce,
            $client->api_key
        );

        return hash_equals($computed, $request->header('X-API-Signature'));
    }
}
