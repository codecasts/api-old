<?php

namespace Codecasts\Domains\Users\Providers;

use Codecasts\Domains\Users\Events\Subscriptions\InvoiceDue;
use Codecasts\Domains\Users\Events\Subscriptions\InvoiceDunning;
use Codecasts\Domains\Users\Events\Subscriptions\InvoiceInstallmentReleased;
use Codecasts\Domains\Users\Events\Subscriptions\InvoicePaymentFailed;
use Codecasts\Domains\Users\Events\Subscriptions\InvoiceRefund;
use Codecasts\Domains\Users\Events\Subscriptions\InvoiceReleased;
use Codecasts\Domains\Users\Events\Subscriptions\InvoiceStatusChanged;
use Codecasts\Domains\Users\Events\Subscriptions\SubscriptionActivated;
use Codecasts\Domains\Users\Events\Subscriptions\SubscriptionChanged;
use Codecasts\Domains\Users\Events\Subscriptions\SubscriptionCreated;
use Codecasts\Domains\Users\Events\Subscriptions\SubscriptionExpired;
use Codecasts\Domains\Users\Events\Subscriptions\SubscriptionRenewed;
use Codecasts\Domains\Users\Events\Subscriptions\SubscriptionSuspended;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyFailedPayment;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyInstallmentReleased;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyInvoiceDue;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyInvoiceDunning;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyInvoiceRefund;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyInvoiceReleased;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyInvoiceStatusChanged;
use Codecasts\Domains\Users\Listeners\Notifications\NotifyNewInvoice;
use Codecasts\Domains\Users\Events\Subscriptions\InvoiceCreated;
use Codecasts\Domains\Users\Listeners\Notifications\NotifySubscriptionActivated;
use Codecasts\Domains\Users\Listeners\Notifications\NotifySubscriptionChanged;
use Codecasts\Domains\Users\Listeners\Notifications\NotifySubscriptionCreated;
use Codecasts\Domains\Users\Listeners\Notifications\NotifySubscriptionExpired;
use Codecasts\Domains\Users\Listeners\Notifications\NotifySubscriptionRenewed;
use Codecasts\Domains\Users\Listeners\Notifications\NotifySubscriptionSuspended;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        InvoiceCreated::class => [
            NotifyNewInvoice::class,
        ],
        InvoiceStatusChanged::class => [
            NotifyInvoiceStatusChanged::class,
        ],
        InvoiceRefund::class => [
            NotifyInvoiceRefund::class,
        ],
        InvoicePaymentFailed::class => [
            NotifyFailedPayment::class,
        ],
        InvoiceDue::class => [
            NotifyInvoiceDue::class,
        ],
        InvoiceDunning::class => [
            NotifyInvoiceDunning::class,
        ],
        InvoiceInstallmentReleased::class => [
            NotifyInstallmentReleased::class,
        ],
        InvoiceReleased::class => [
            NotifyInvoiceReleased::class,
        ],
        SubscriptionSuspended::class => [
            NotifySubscriptionSuspended::class,
        ],
        SubscriptionExpired::class => [
            NotifySubscriptionExpired::class,
        ],
        SubscriptionActivated::class => [
            NotifySubscriptionActivated::class,
        ],
        SubscriptionCreated::class => [
            NotifySubscriptionCreated::class,
        ],
        SubscriptionRenewed::class => [
            NotifySubscriptionRenewed::class,
        ],
        SubscriptionChanged::class => [
            NotifySubscriptionChanged::class,
        ]
    ];

    /**
     * @param DispatcherContract $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
