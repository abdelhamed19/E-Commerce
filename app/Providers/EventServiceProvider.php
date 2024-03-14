<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\ClearCart;
use App\Listeners\DecreaseQuantity;
use App\Listeners\SendOrderCreatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'order_created'=>[
            DecreaseQuantity::class,
            ClearCart::class,
            SendOrderCreatedNotification::class,
        ]

        // OrderCreated::class => [
        //     DecreaseQuantity::class,
        //     ClearCart::class,
        //     SendOrderCreatedNotification::class,
        // ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
