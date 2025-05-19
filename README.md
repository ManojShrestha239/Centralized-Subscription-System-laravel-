# Centralized Subscription System

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php)
![License](https://img.shields.io/badge/license-MIT-blue)

A robust subscription management system built with Laravel 12 and Tailwind CSS v4 that enables centralized control over subscription services across multiple client applications.

## Features

-   **User Authentication**: Secure login and registration system
-   **Client Management**: Create and manage client domains
-   **API Key Generation**: Auto-generates 40-character API keys for each client
-   **Secure Storage**: API keys are stored using Laravel's hashing system
-   **Subscription Verification**: Middleware for client applications to check subscription status
-   **Centralized Control**: Single dashboard to manage all subscriptions

## Prerequisites

-   PHP 8.2+
-   Composer
-   Node.js 16+
-   MySQL 5.7+ or MariaDB 10.3+
-   Laravel 12

## Installation

1. Clone the repository:
   `git clone https://github.com/yourusername/centralized-subscription-system.git`
   `cd centralized-subscription-system`

2. Install PHP dependencies:
   `composer install`

3. Install JavaScript dependencies:
   `npm install`

4. Create a copy of the .env file:
   `cp .env.example .env`

5. Generate application key:
   `php artisan key:generate`

6. Configure your database settings in the .env file:
   `DB_DATABASE=your_database_name`
   `DB_USERNAME=your_database_username`
   `DB_PASSWORD=your_database_password`

7. Run migrations:
   `php artisan migrate --seed`

8. Compile assets:
   `npm run build`

9. Start the development server:
   `php artisan serve`

## Client Application Setup

To integrate a client application with the Centralized Subscription System:

1. Copy the CheckSubscriptionMiddleware.php to your client application's middleware directory.
2. Add the following configuration to your client's config/services.php:
   'subscription_api' => [
   'secret' => env('SUBSCRIPTION_API_KEY'),
   'domain' => env('APP_URL'),
   'url' => env('SUBSCRIPTION_API_URL'),
   'redirect_url' => env('SUBSCRIPTION_API_REDIRECT_URL'),
   ],
3. Add these variables to your client's .env file:
   SUBSCRIPTION_API_KEY="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
   SUBSCRIPTION_API_URL="http://127.0.0.1:8000/"
   SUBSCRIPTION_API_REDIRECT_URL="https://example.com/checking-subscription/"
4. Apply the middleware to your routes as needed.

## API Key Security

    - All API keys are automatically generated as 40-character strings
    - Keys are stored using Laravel's hashing mechanism for security
    - Never expose raw API keys in your application - always use the hashed version for verification

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

## Deployment

For production deployment, consider:

1. Configuring proper SSL certificates
2. Setting up queue workers for background jobs
3. Implementing a backup strategy for your database
4. Configuring proper caching mechanisms

Contributing

Contributions are welcome! Please follow these steps:

1. Fork the project
2. Create your feature branch (git checkout -b feature/AmazingFeature)
3. Commit your changes (git commit -m 'Add some AmazingFeature')
4. Push to the branch (git push origin feature/AmazingFeature)
5. Open a Pull Request

## License

Distributed under the MIT License. See LICENSE for more information.
Support

For issues or questions, please open an issue on GitHub or contact the maintainer.
