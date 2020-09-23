<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\TraitsFolder\CommonTrait;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use CommonTrait;
    /*
    |--------------------------------------------------------------------------
    |Contrôleur de réinitialisation de mot de passe
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur est responsable de la gestion des e-mails de réinitialisation de mot de passe et
    | inclut un trait qui aide à envoyer ces notifications de
    | votre application à vos utilisateurs. N'hésitez pas à explorer ce trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Créez une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm()
    {
        return view('admin.passwords.email');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $us = Admin::whereEmail($request->email)->count();
        if ($us == 0)
        {
            session()->flash('message','Nous ne pouvons pas trouver un utilisateur avec cette adresse e-mail.');
            session()->flash('type','danger');
            return redirect()->back();
        }else{
            $user1 = Admin::whereEmail($request->email)->first();
            $route = 'admin.password.reset';
            $this->userPasswordReset($user1->email,$user1->name,$route);
            session()->flash('message','Lien de réinitialisation du mot de passe. Envoyez votre e-mail');
            session()->flash('type','success');
            return redirect()->back();
        }

    }
}
