<?php

namespace App\Providers;

use App\Models\Bandeira;
use App\Models\Colaborador;
use App\Models\Grupo;
use App\Models\Unidade;
use Illuminate\Support\ServiceProvider;

use App\Observers\BandeiraObserver;
use App\Observers\ColaboradorObserver;
use App\Observers\GrupoObserver;
use App\Observers\UnidadeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Bandeira::observe(BandeiraObserver::class);
        Grupo::observe(GrupoObserver::class);
        Unidade::observe(UnidadeObserver::class);
        Colaborador::observe(ColaboradorObserver::class);
    }
}
