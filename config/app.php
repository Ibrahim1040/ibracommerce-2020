<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | Cette valeur est le nom de votre application. Cette valeur est utilisée lorsque le
    | cadre doit placer le nom de l'application dans une notification ou
    | tout autre emplacement requis par l'application ou ses packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Environnement d'application
    |--------------------------------------------------------------------------
    |
    | Cette valeur détermine l '"environnement" de votre application actuellement
    | en cours d'exécution. Cela peut déterminer comment vous préférez configurer divers
    | services que votre application utilise. Réglez-le dans votre fichier ".env".
    |
    */

    'env' => env('APP_ENV', 'development'),

    /*
    |--------------------------------------------------------------------------
    | Mode de débogage d'application
    |--------------------------------------------------------------------------
    |
    |Lorsque votre application est en mode débogage, des messages d'erreur détaillés avec
    | des traces de pile seront affichées sur chaque erreur qui se produit dans votre
    | application. S'il est désactivé, une simple page d'erreur générique s'affiche.
    |
    */

    'debug' => env('APP_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | URL d'application
    |--------------------------------------------------------------------------
    |
    |Cette URL est utilisée par la console pour générer correctement des URL lors de l'utilisation
    | l'outil de ligne de commande Artisan. Vous devez définir cela à la racine de
    | votre application afin qu'elle soit utilisée lors de l'exécution de tâches Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Fuseau horaire de l'application
    |--------------------------------------------------------------------------
    |
    | Ici, vous pouvez spécifier le fuseau horaire par défaut pour votre application, qui
    | sera utilisé par les fonctions PHP date et date-heure. Nous sommes partis
    | avant et définissez-le sur une valeur par défaut raisonnable pour vous hors de la boîte.
    |
    */

    'timezone' => 'Europe/Brussels',

    /*
    |--------------------------------------------------------------------------
    | Configuration des paramètres régionaux de l'application
    |--------------------------------------------------------------------------
    |
    | Les paramètres régionaux de l'application déterminent les paramètres régionaux par défaut qui seront utilisés
    | par le prestataire de services de traduction. Vous êtes libre de définir cette valeur
    | à l'un des paramètres régionaux qui seront pris en charge par l'application.
    |
    */

    'locale' => 'fr',

    /*
    |--------------------------------------------------------------------------
    | Paramètres régionaux de secours de l'application
    |--------------------------------------------------------------------------
    |
    |Les paramètres régionaux de secours déterminent les paramètres régionaux à utiliser lorsque ceux en cours
    | n'est pas disponible. Vous pouvez modifier la valeur pour correspondre à
    | les dossiers de langues fournis via votre application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Clé de cryptage
    |--------------------------------------------------------------------------
    |
    | Cette clé est utilisée par le service de chiffrement Illuminate et doit être définie
    | à une chaîne aléatoire de 32 caractères, sinon ces chaînes chiffrées
    | ne sera pas en sécurité. Veuillez le faire avant de déployer une application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Configuration de la journalisation
    |--------------------------------------------------------------------------
    |
    | Ici, vous pouvez configurer les paramètres du journal pour votre application. Hors de
    | Dans la boîte, Laravel utilise la bibliothèque de journalisation PHP Monolog. Cela donne
    | vous une variété de gestionnaires / formateurs de journaux puissants à utiliser.
    |
    | Paramètres disponibles: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Fournisseurs de services chargés automatiquement
    |--------------------------------------------------------------------------
    |
    | Les fournisseurs de services répertoriés ici seront automatiquement chargés sur le
    | demande à votre candidature. N'hésitez pas à ajouter vos propres services à
    | ce tableau pour accorder des fonctionnalités étendues à vos applications.
    |
    */

    'providers' => [

        /*
         * Fournisseurs de services Framework Laravel ...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Fournisseurs de services provider ...
         */
        Collective\Html\HtmlServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        Evercode1\TraitMaker\TraitMakerServiceProvider::class,
        Gloudemans\Shoppingcart\ShoppingcartServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Alias de classe
    |--------------------------------------------------------------------------
    |
    | Ce tableau d'alias de classe sera enregistré lorsque cette application
    | a démarré. Cependant, n'hésitez pas à vous inscrire autant que vous le souhaitez
    | les alias sont chargés paresseusement afin de ne pas nuire aux performances.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'Cart' => Gloudemans\Shoppingcart\Facades\Cart::class,

    ],

];
