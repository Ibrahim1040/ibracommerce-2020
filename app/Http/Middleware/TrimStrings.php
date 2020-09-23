<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Les noms des attributs qui ne doivent pas être supprimés.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
