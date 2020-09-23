<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Contrôleur de connexion
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur gère l'authentification des utilisateurs de l'application et
    | les rediriger vers votre écran d'accueil. Le contrôleur utilise un trait
    | pour fournir facilement ses fonctionnalités à vos applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Où rediriger les utilisateurs après la connexion.
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
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function username()
    {
        return 'email';
    }

    public function logout()
    {
        $this->guard('admin')->logout();
        session()->flash('message', 'Juste déconnecté!');
        return redirect('/admin');
    }

}
