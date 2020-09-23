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
                    <div class="checkout-step mb-40">
                        <ul>
                            <li class="active"> <a href="{{ route('check-out') }}">
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">1</div>
                                    </div>
                                    <span>livraison</span> </a> </li>
                            <li> <a href="{{ route('oder-overview') }}">
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">2</div>
                                    </div>
                                    <span>Aperçu de la commande</span> </a> </li>
                            <li> <a>
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">3</div>
                                    </div>
                                    <span>Paiement</span> </a> </li>
                            <li> <a>
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">4</div>
                                    </div>
                                    <span>Commande terminée</span> </a> </li>
                            <li>
                                <div class="step">
                                    <div class="line"></div>
                                </div>
                            </li>
                        </ul>
                        <hr>
                    </div>
                    <div class="checkout-content" >
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="heading-part align-center">
                                    <h2 class="heading">Veuillez remplir vos coordonnées de livraison</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                                <form action="{{ route('submit-details') }}" class="main-form full" method="post">
                                    {!! csrf_field() !!}
                                    @if($userDetails== null)
                                    <div class="mb-20">
                                        <div class="row">
                                            <div class="col-xs-12 mb-20">
                                                <div class="heading-part">
                                                    <h3 class="sidebar-title">Adresse de livraison</h3>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Nom et prénom *</label>
                                                    <input type="text" name="s_name" value="{{ $user->first_name }} {{ $user->last_name }}" required >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Adresse e-mail *</label>
                                                    <input type="email" name="s_email" value="{{ $user->email }}" required >
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Compagnie</label>
                                                    <input type="text" name="s_company">
                                                </div>
                                            </div>
                                        
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Numéro de téléphone *</label>
                                                    <input type="text" name="s_number" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Pays *</label>
                                                    <select name="s_country" id="shippingcountryid">
                                                        <option selected="" value="">Séléctionnez un pays * </option>
                                                        @foreach($country as $cc => $value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Ville *</label>
                                                    <input type="text" name="s_state" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Commune *</label>
                                                    <input type="text" name="s_city" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Code postal *</label>
                                                    <input type="text" name="s_zip" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Adresse *</label>
                                                    <textarea name="s_address" required></textarea>
                                                    <span style="color:red;">Veuillez indiquez la rue et le numéro svp</span> </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <label for="">Point relais *</label>
                                                    <textarea name="s_landmark" required></textarea>
                                                    <span style="color:red;">Veuillez indiquez un point de relais en cas d'absence,svp</span> </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-xs-12 mb-20">
                                                <div class="heading-part">
                                                    <h3 class="sub-heading">Adresse de facturation</h3>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <input type="text" name="b_name" value="{{ $user->first_name }} {{ $user->last_name }}" required placeholder="Nom et prénom">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <input type="text" name="b_email" value="{{ $user->email }}" required placeholder="Adresse">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <input type="text" name="b_company"  placeholder="Compagnie">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <input type="text" name="b_number" required placeholder="Numéro de téléphone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <select name="b_country" id="shippingcountryid">
                                                        <option selected="" value="">Sélectionnez un pays</option>
                                                        @foreach($country as $cc => $value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <input type="text" name="b_state" required placeholder="Ville">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <input type="text" name="b_city" required placeholder="Commune">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-box">
                                                    <input type="text" name="b_zip" required placeholder="Code postal">
                                                </div>
                                            </div>
                                            <div class="col-sm-12"> <button type="submit" class="btn btn-color btn-block right-side">Suivant</button> </div>
                                        </div>
                                    </div>
                                    @else
                                        <div class="mb-20">
                                            <div class="row">
                                                <div class="col-xs-12 mb-20">
                                                    <div class="heading-part">
                                                        <h3 class="sidebar-title">Adresse de livraison</h3>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="s_name" value="{{ $user->first_name }} {{ $user->last_name }}" required placeholder="Nom et prénom">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="email" name="s_email" value="{{ $user->email }}" required placeholder="Adresse mail">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="s_company" value="{{ $userDetails->s_company }}" placeholder="Compagnie">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="s_number" value="{{ $userDetails->s_number }}" required placeholder="Numéro de téléphone ">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <select name="s_country" id="shippingcountryid">
                                                            <option selected="" value="">Sélectionnez un pays</option>
                                                            @foreach($country as $cc => $value)
                                                                @if($userDetails->s_country == $value)
                                                                <option value="{{ $value }}" selected>{{ $value }}</option>
                                                                @else
                                                                <option value="{{ $value }}">{{ $value }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="s_state" value="{{ $userDetails->s_state }}" required placeholder="Ville ">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="s_city" value="{{ $userDetails->s_city }}" required placeholder="Commune">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="s_zip" value="{{ $userDetails->s_zip }}" required placeholder="Code postal">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="input-box">
                                                        <textarea name="s_address" required placeholder="Adresse">{{ $userDetails->s_address }}</textarea>
                                                        <span>S'il vous plaît fournir le numéro et la rue.</span> </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="input-box">
                                                        <input type="text" name="s_landmark" value="{{ $userDetails->s_landmark }}" required placeholder="Point relais">
                                                        <span>Veuillez indiquez un point de relais en cas d'absence,svp</span> </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-12 mb-20">
                                                    <div class="heading-part">
                                                        <h3 class="sub-heading">Adresse de facturation</h3>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="b_name" value="{{ $user->first_name }} {{ $user->last_name }}" required placeholder="Nom et prénom">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="b_email" value="{{ $user->email }}" required placeholder="Adresse mail">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="b_company" value="{{ $userDetails->b_company }}"  placeholder="Compagnie">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="b_number" value="{{ $userDetails->b_number }}" required placeholder="Numéro de téléphone ">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <select name="b_country" id="shippingcountryid">
                                                            <option selected="" value="">Sélectionnez un pays</option>
                                                            @foreach($country as $cc => $value)
                                                                @if($userDetails->b_country == $value)
                                                                <option value="{{ $value }}" selected>{{ $value }}</option>
                                                                @else
                                                                <option value="{{ $value }}">{{ $value }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="b_state" value="{{ $userDetails->b_state }}" required placeholder="Ville">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="b_city" value="{{ $userDetails->b_city }}" required placeholder="Commune">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-box">
                                                        <input type="text" name="b_zip" value="{{ $userDetails->b_zip }}" required placeholder="Code postal">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12"> <button type="submit" class="btn btn-color btn-block right-side">Suivant</button> </div>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->


@endsection