<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Cet espace de noms est appliqué à vos routes de contrôleur.
     *
     * De plus, il est défini comme espace de noms racine du générateur d'URL.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Définissez les liaisons de votre modèle d'itinéraire, les filtres de modèle, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Définissez les itinéraires de l'application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Définissez les routes "web" pour l'application.
     *
     * Ces routes reçoivent toutes l'état de session, la protection CSRF, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Définissez les routes "api" pour l'application.
     *
     * Ces routes sont généralement sans état.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
