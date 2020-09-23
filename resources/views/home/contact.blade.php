@extends('layouts.fontEnd')
@section('content')

    <!-- BANNER STRAT -->
    <div class="banner inner-banner align-center" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}');">
        <div class="container">
            <section class="banner-detail">
                
                <div class="bread-crumb right-side">
                    <ul>
                        <li><a href="{{ route('home') }}">Accueil</a>/</li>
                        <li><span>Contact</span></li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <!-- BANNER END -->

    <!-- CONTAIN START ptb-50-->
    <section class="pt-50">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="map">
                        <div class="map-part">
                            <div id="map" class="map-inner-part">
                                {!! $basic->google_map !!}
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
    <section class="pt-50 client-main align-center">
        <div class="container">
            <div class="contact-info ">
                <div class="row m-0">
                    <div class="col-sm-4 p-0" style="margin-bottom:50px">
                        <div class="contact-box">
                            <div class="contact-icon contact-phone-icon"><i class="fa fa-phone"></i></div>
                            <span><b>Numéro de téléphone</b></span>
                            <p>{{ $basic->phone }}</p>
                        </div>
                    </div>
                    <div class="col-sm-4 p-0">
                        <div class="contact-box">
                            <div class="contact-icon contact-mail-icon"><i class="fa fa-envelope-open"></i></div>
                            <span><b>Adresse E-mail</b></span>
                            <p><a href="mailto:{{$basic->email}}">{{ $basic->email }}</a> </p>
                        </div>
                    </div>
                    <div class="col-sm-4 p-0">
                        <div class="contact-box">
                            <div class="contact-icon contact-open-icon"><i class="fa fa-map-marker"></i></div>
                            <span><b>Adresse</b></span>
                            <p>{{$basic->address}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cette partie permet d'envoyer un message à l'admin -->
    <!--
    <section class="ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="heading-part mb-20">
                        <h2 class="main_title">Envoyer un message!</h2>
                    </div>
                </div>
            </div>
            <div class="main-form">
                <div class="row">
                    <div class="col-md-12">   

                    <form action="contact-us" method="POST"  name="contactform">
                        @csrf
                        <div class="form-group $errors('name') is-invalid @enderror col-sm-6 mb-30">
                            <label for="name" class="control-label">Nom</label>
                            <input type="text" name="name" id="name" class="form-control "required="required" value="{{ old('name') }}">
                            -->
                            <!--{!! $errors->first('name','<span class="help-block">:message</span>') !!}-->
                            <!--
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }} col-sm-6 mb-30">
                            <label for="subject" class="control-label">Sujet</label>
                            <input type="text" name="subject" id="subject" class="form-control" required="required" value="{{ old('subject') }}">
                            {!! $errors->first('subject','<span class="help-block">:message</span>') !!}
                            
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} col-sm-6 mb-30">
                            <label for="email" class="control-label">E-mail</label>
                            <input type="email" required="required"  class="form-control" name="email" value="{{ old('email') }}">
                            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }} col-sm-6 mb-30">
                            <label for="phone" class="control-label">Téléphone</label>
                            <input type="text" required="required" class="form-control" name="phone" value="{{ old('phone') }}">
                            {!! $errors->first('phone','<span class="help-block">:message</span>') !!}
                        </div>
                                               
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }} col-sm-6 mb-30">
                            <label for="message" class="control-label">Votre message</label>
                            <textarea class="form-control" rows="5" cols="30"  required="required" name="message" id="message" value="{{ old('message') }}"></textarea>
                            {!! $errors->first('message','<span class="help-block">:message</span>') !!}
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6 mb-30">
                            <div class="align-center">
                                <button type="submit" name="submit" class="btn-color btn-block"><i class="fa fa-send"></i> Envoyez message</button>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-30">
                            <div class="align-center">
                                <button type="reset" class="btn-block btn-danger" style="border: none"><i class="fa fa-recycle"></i> Vider tout</button>
                            </div>
                        </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
    -->
    <!-- CONTAINER END -->



@endsection