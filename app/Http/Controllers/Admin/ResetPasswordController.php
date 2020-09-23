<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Contrôleur de réinitialisation de mot de passe
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur est responsable du traitement des demandes de réinitialisation de mot de passe
    | et utilise un trait simple pour inclure ce comportement. Vous êtes libre de
    | explorez ce trait et remplacez toutes les méthodes que vous souhaitez modifier.
    |
    */

    use ResetsPasswords;

    /**
     * Où rediriger les utilisateurs après avoir réinitialisé leur mot de passe.
     *
     * @var string
     */
    protected $redirectTo = '/admin-dashboard';

    /**
     * Créez une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Obtenez le protecteur à utiliser lors de la réinitialisation du mot de passe.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

}
