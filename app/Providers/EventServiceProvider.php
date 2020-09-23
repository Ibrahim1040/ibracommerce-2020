<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Mappages de l'écouteur d'événements pour l'application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Enregistrez tous les événements pour votre application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
