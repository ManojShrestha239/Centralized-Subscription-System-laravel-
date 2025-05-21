# Centralized Subscription System

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php)
![License](https://img.shields.io/badge/license-MIT-blue)

A robust subscription management system built with Laravel 12 and Tailwind CSS v4 that enables centralized control over subscription services across multiple client applications.

---

## Table of Contents

-   [Features](#features)
-   [Prerequisites](#prerequisites)
-   [Installation](#installation)
-   [Client Application Setup](#client-application-setup)
-   [API Key Security](#api-key-security)
-   [Usage](#usage)
-   [Deployment](#deployment)
-   [Contributing](#contributing)
-   [License](#license)
-   [Support](#support)

---

## Features

-   **User Authentication**: Secure login and registration system.
-   **Client Management**: Create and manage client domains.
-   **API Key Generation**: Auto-generates 40-character API keys for each client.
-   **Secure Storage**: API keys are stored using Laravel's hashing system.
-   **Subscription Verification**: Middleware for client applications to check subscription status.
-   **Centralized Control**: Single dashboard to manage all subscriptions.

---

## Prerequisites

Ensure you have the following installed:

-   PHP 8.2+
-   Composer
-   Node.js 16+
-   MySQL 5.7+ or MariaDB 10.3+
-   Laravel 12

---

## Installation

Follow these steps to set up the project:

1. Clone the repository:

    ```bash
    git clone https://github.com/ManojShrestha239/Centralized-Subscription-System-laravel-.git
    cd centralized-subscription-system
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install
    ```

4. Create a copy of the .env file:

    ```bash
    cp .env.example .env
    ```

5. Generate application key:

    ```bash
    php artisan key:generate
    ```

6. Configure your database settings in the .env file:

    ```dotenv
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

7. Run migrations:

    ```bash
    php artisan migrate --seed
    ```

8. Compile assets:

    ```bash
    npm run build
    ```

9. Start the development server:
    ```bash
    php artisan serve
    ```

---

## Client Application Setup

To integrate a client application with the Centralized Subscription System:

1.  Create a Middleware: Create a new middleware file in your client application's middleware directory (e.g., CheckSubscriptionMiddleware.php) and add the following code

````php
        class CheckSubscriptionMiddleware
        {
        public function handle(Request $request, Closure $next)
        {
            if (!$request->secure() && config('app.env') === 'production') {
        abort(403, 'Secure connection required');
        }

                $domain = config('services.subscription_api.domain');
                $apiSecret = config('services.subscription_api.secret');

                if (!$apiSecret || !$domain) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'System configuration error'
                    ], 500)->withHeaders($this->securityHeaders());
                }

                $timestamp = now()->timestamp;
                $nonce = Str::uuid()->toString();

                $signature = hash_hmac(
                    'sha256',
                    $timestamp . $domain . $nonce,
                    $apiSecret
                );
                $baseUrl = config('services.subscription_api.url');
                $endpoint = rtrim($baseUrl, '/') . '/api/check-subscription';

                try {
                    $response = Http::withHeaders([
                        'X-API-Signature' => $signature,
                        'X-API-Timestamp' => $timestamp,
                        'X-API-Nonce' => $nonce,
                        'X-API-Domain' => $domain
                    ])
                        ->timeout(3)
                        ->retry(2, 100)
                        ->post($endpoint, [
                            'domain' => $domain,
                            'timestamp' => $timestamp
                        ]);

                    return $this->handleApiResponse($response, $request, $next);
                } catch (ConnectionException $e) {
                    return $this->handleFallbackVerification($request, $next);
                }
            }

            private function handleApiResponse($response, $request, $next)
            {
                $status = $response->status();

                if ($status === 200 && $response->json('status') === 'active') {
                    $this->cacheSubscriptionStatus();
                    return $next($request)->withHeaders($this->securityHeaders());
                }

                if ($response->json('status') === 'expired') {
                    $responseData = $response->json();
                    if (
                        isset($responseData['status']) && $responseData['status'] === 'expired' &&
                        isset($responseData['message']) && $responseData['message'] === 'Subscription expired'
                    ) {

                        $redirectUrl = isset($responseData['redirect_url']) ?
                            $responseData['redirect_url'] :
                            config('services.subscription_api.redirect_url');

                        return redirect()->to($redirectUrl);
                    }

                    return redirect()->to(config('services.subscription_api.redirect_url'));
                }

                return response()->json([
                    'status' => 'error',
                    'message' => 'Service temporarily unavailable'
                ], 503)->withHeaders($this->securityHeaders());
            }

            private function securityHeaders()
            {
                return [
                    'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
                    'X-Content-Type-Options' => 'nosniff',
                    'X-Frame-Options' => 'DENY',
                    // 'Content-Security-Policy' => "default-src 'self'"
                ];
            }

            private function handleFallbackVerification($request, $next)
            {
                $domain = config('services.subscription_api.domain');
                $lastVerified = Cache::get('subscription_status_' . md5($domain));

                if ($lastVerified && $lastVerified['expires_at'] > now()) {
                    return $next($request);
                }

                return response()->json([
                    'status' => 'error',
                    'message' => 'Service unavailable'
                ], 503)->withHeaders($this->securityHeaders());
            }

            private function cacheSubscriptionStatus()
            {
                $domain = config('services.subscription_api.domain');
                Cache::put(
                    'subscription_status_' . md5($domain),
                    ['expires_at' => now()->addMinutes(5)],
                    300
                );
            }

        }
        ```

2.  Register the Middleware Alias:
    Open your app/Http/Kernel.php file and register the middleware alias in the $routeMiddleware array:

```php
protected $routeMiddleware = [
    // ...existing middleware...
    'check.subscription' => \App\Http\Middleware\CheckSubscriptionMiddleware::class,
];
````

3. Apply Middleware Globally (Optional):
   If you want to apply the middleware to all routes, add it to the $middleware array in the same file:

```php
protected $middleware = [
    // ...existing middleware...
    \App\Http\Middleware\CheckSubscriptionMiddleware::class,
];
```

4. Apply Middleware to Specific Routes:
   If you prefer to apply the middleware to specific routes, use the alias in your route definitions:

```php
Route::middleware(['check.subscription'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

5.  Add the following configuration to your client's config/services.php:
    ```php
    'subscription_api' => [
        'secret' => env('SUBSCRIPTION_API_KEY'),
        'domain' => env('APP_URL'),
        'url' => env('SUBSCRIPTION_API_URL'),
        'redirect_url' => env('SUBSCRIPTION_API_REDIRECT_URL'),
    ],
    ```
6.  Add these variables to your client's .env file:
    ```dotenv
    SUBSCRIPTION_API_KEY="xxxxxxxxAPI_KEYxxxxxxxx"
    SUBSCRIPTION_API_URL="http://127.0.0.1:8000/"
    SUBSCRIPTION_API_REDIRECT_URL="https://example.com/checking-subscription/"
    ```
7.  Apply the middleware to your routes as needed.

---

## API Key Security

-   All API keys are automatically generated as 40-character strings.
-   Keys are stored using Laravel's hashing mechanism for security.
-   Never expose raw API keys in your application - always use the hashed version for verification.

---

## Usage

1.  Dashboard Access:

-   Register a new account or login with existing credentials
-   Access the admin dashboard to manage clients and subscriptions

2.  Client Management:

-   Add new client domains
-   View and manage generated API keys
-   Monitor subscription statuses

3.  Subscription Verification:

-   Client applications will automatically verify subscription status
-   Unauthorized access will be redirected as configured

---

## Deployment

For production deployment, consider:

1. Configuring proper SSL certificates
2. Setting up queue workers for background jobs
3. Implementing a backup strategy for your database
4. Configuring proper caching mechanisms

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the project
2. Create your feature branch (git checkout -b feature/AmazingFeature)
3. Commit your changes (git commit -m 'Add some AmazingFeature')
4. Push to the branch (git push origin feature/AmazingFeature)
5. Open a Pull Request

---

## License

Distributed under the MIT License. See LICENSE for more information.

---

## Support

For issues or questions, please open an issue on GitHub or contact the maintainer.
