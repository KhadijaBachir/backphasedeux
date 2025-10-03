<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Importation ajoutée ici

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Vérifie si l'application tourne dans un environnement de production
        // (comme Render) et force la génération de toutes les URLs en HTTPS
        // pour éviter le problème de "Contenu Mixte" (Mixed Content) du navigateur.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
