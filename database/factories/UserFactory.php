<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Usines modèles
|--------------------------------------------------------------------------
|
| Ce répertoire doit contenir chacune des définitions d'usine de modèle pour
| ton application. Les usines offrent un moyen pratique de générer de nouvelles
| des instances de modèle pour tester / amorcer la base de données de votre application.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
