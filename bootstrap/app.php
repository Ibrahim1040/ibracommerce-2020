<?php

/*
|--------------------------------------------------------------------------
| Créer l'application
|--------------------------------------------------------------------------
|
| La première chose que nous ferons est de créer une nouvelle instance d'application Laravel
| qui sert de "colle" pour tous les composants de Laravel, et est
| le conteneur IoC pour le système liant toutes les différentes parties.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Lier des interfaces importantes
|--------------------------------------------------------------------------
|
| Ensuite, nous devons lier certaines interfaces importantes dans le conteneur afin
| nous pourrons les résoudre en cas de besoin. Les grains servent le
| les demandes entrantes vers cette application à partir du Web et de la CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Renvoyer la demande
|--------------------------------------------------------------------------
|
| Ce script renvoie l'instance d'application. L'instance est donnée à
| le script appelant afin que nous puissions séparer la construction des instances
| de l'exécution réelle de l'application et l'envoi de réponses.
|
*/

return $app;
