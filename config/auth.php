<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Valeurs par défaut d'authentification
    |--------------------------------------------------------------------------
    |
    | Cette option contrôle l'authentification par défaut « guard » et mot de passe
    | réinitialiser les options de votre application. Vous pouvez modifier ces valeurs par défaut
    | comme requis, mais ils sont un début parfait pour la plupart des applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    |Gardes d'authentification
    |--------------------------------------------------------------------------
    |
    | Ensuite, vous pouvez définir chaque garde d'authentification pour votre application.
    | Bien sûr, une excellente configuration par défaut a été définie pour vous
    | ici qui utilise le stockage de session et le fournisseur d'utilisateurs Eloquent.
    |
    | Tous les pilotes d'authentification ont un fournisseur d'utilisateurs. Cela définit comment
    | les utilisateurs sont en fait récupérés de votre base de données ou autre stockage
    | mécanismes utilisés par cette application pour conserver les données de votre utilisateur.
    |
    | Pris en charge: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'staff' => [
            'driver' => 'session',
            'provider' => 'staff',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Fournisseurs d'utilisateurs
    |--------------------------------------------------------------------------
    |
    | Tous les pilotes d'authentification ont un fournisseur d'utilisateurs. Cela définit comment
    | les utilisateurs sont en fait récupérés de votre base de données ou autre stockage
    | mécanismes utilisés par cette application pour conserver les données de votre utilisateur.
    |
    | Si vous avez plusieurs tables ou modèles utilisateur, vous pouvez configurer plusieurs
    | sources qui représentent chaque modèle / tableau. Ces sources peuvent alors
    | être affecté à tous les gardes d'authentification supplémentaires que vous avez définis.
    |
    | Pris en charge: "base de données", "éloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],

        'staff' => [
            'driver' => 'eloquent',
            'model' => App\Staff::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Réinitialisation des mots de passe
    |--------------------------------------------------------------------------
    |
    | Vous pouvez spécifier plusieurs configurations de réinitialisation de mot de passe si vous en avez plus
    | d'une table ou d'un modèle utilisateur dans l'application et que vous souhaitez avoir
    | des paramètres de réinitialisation de mot de passe distincts en fonction des types d'utilisateurs spécifiques.
    |
    | Le délai d'expiration est le nombre de minutes pendant lesquelles le jeton de réinitialisation doit être
    | considéré comme valide. Cette fonctionnalité de sécurité maintient les jetons de courte durée afin
    | ils ont moins de temps à deviner. Vous pouvez modifier cela au besoin.
    |
    */
    /** c'est ici qu'on limite le délai de réinitialisation du mot de passe 
     * dans ce cas le délai est de 60 minutes
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'staff' => [
            'provider' => 'staff',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
