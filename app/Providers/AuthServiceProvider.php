<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Arbitro::class => \App\Policies\ArbitroPolicy::class,
        \App\Models\Equipo::class => \App\Policies\EquipoPolicy::class,
        \App\Models\Jornada::class => \App\Policies\JornadaPolicy::class,
        \App\Models\Partido::class => \App\Policies\PartidoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
