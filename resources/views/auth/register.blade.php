@extends('layouts.fontEnd')
@section('content')


    <!-- BANNER STRAT -->
    <div class="banner inner-banner align-center" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}');">
        <div class="container">
            <section class="banner-detail">
                <h1 class="banner-title">{{ $page_title }}</h1>
                <div class="bread-crumb right-side">
                    <ul>
                        <li><a href="{{ route('home') }}">Accueil</a>/</li>
                        <li><span>{{ $page_title }}</span></li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <!-- BANNER END -->


    <!-- CONTAIN START -->
    <section class="checkout-section ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2">
                        <!-- le csrf va envoyer un jeton pour éviter les attaques -->
                            <form class="main-form full" action="{{ route('register') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-xs-12 mb-20">
                                        <div class="sidebar-title">
                                            <h3>Nouveau Compte</h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    {!!  $error !!}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="f-name">Prénom</label>
                                            <input type="text" id="f-name" name="first_name" value="{{ old('first_name') }}" required placeholder="Prénom">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="l-name">Nom</label>
                                            <input type="text" id="l-name" name="last_name" value="{{ old('last_name') }}" required placeholder="Nom">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="login-email">Adresse e-mail</label>
                                            <input id="login-email" type="email" name="email" value="{{ old('email') }}" required placeholder="Adresse e-mail">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="login-pass">Mot de passe</label>
                                            <input id="login-pass" type="password" name="password" required placeholder="Mot de pasee">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="re-enter-pass">Confirmez mot de passe</label>
                                            <input id="re-enter-pass" type="password" name="password_confirmation" required placeholder="Confirmez mot de passe">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 mb-20">
                                        <div class="check-box">
                                            <span>
                                              <input type="checkbox" name="agree" required class="checkbox">
                                              </span>
                                            <label for="agree">je suis d'accord <a href="{{ route('terms-condition') }}" class="link">Termes & Conditions</a>  </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <button name="submit" type="submit" class="btn-color btn-block right-side">Enregistrer</button>
                                    </div>
                                    <div class="col-xs-12">
                                        <hr>
                                        <div class="new-account align-center mt-20"> <span>J'ai déjà un compte.</span> <a class="link" title="Login" href="{{ route('login') }}">S'identifier</a> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->

@endsection