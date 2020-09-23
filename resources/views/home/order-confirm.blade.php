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
                            <li> <a href="{{ route('check-out') }}">
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">1</div>
                                    </div>
                                    <span>livraison</span> </a> </li>
                            <li class=""> <a href="{{ route('oder-overview') }}">
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
                            <li class="active"> <a>
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">4</div>
                                    </div>
                                    <span>Commande terminée</span> </a> </li>
                            <li class="active">
                                <div class="step">
                                    <div class="line"></div>
                                </div>
                            </li>
                        </ul>
                        <hr>
                    </div>


                    <div class="checkout-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="heading-part align-center">
                                    <h2 class="heading">Commande Confirmée : #{{$order->order_number}}</h2>
                                </div>
                            </div>
                        </div>
                        <div id="cartFullView" class="row">
                            <div class="col-xs-12 mb-xs-30">
                                <div class="sidebar-title">
                                    <h3>Achats Produits</h3>
                                </div>
                                <div class="cart-item-table commun-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                              <th> Produit </th> 
                                              <th> Nom du produit </th> 
                                              <th> Prix </th> 
                                              <th> Sous total </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orderItem as $con)
                                                @php $product = \App\Product::findOrFail($con->product_id) @endphp
                                                <tr id="product_{{$con->rowId}}">
                                                    <td>
                                                        <a href="{{ route('product-details',$product->slug) }}">
                                                            <div class="product-image"><img alt="{{ $con->name }}" src="{{ asset('assets/images/product') }}/{{$product->image}}"></div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="product-title">
                                                            <a href="{{ route('product-details',$product->slug) }}">{{ $product->name }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <div class="base-price price-box"> <span class="price"> {{ $con->qty }} x {{ $product->current_price }} {{$basic->symbol}}</span> </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td><div class="total-price price-box"> <span class="price">{{ $product->current_price * $con->qty  }} {{$basic->symbol}}</span> </div></td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <div class="cart-total-table commun-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>Article</td>
                                                <td><div class="price-box"> <span class="price">{{ $order->subtotal }} {{ $basic->symbol }}</span> </div></td>
                                            </tr>
                                            <tr>
                                                <td>TVA  {{ $basic->tax }} %  </td>
                                                <td><div class="price-box"> <span class="price"> {{ $order->tax }} {{ $basic->symbol }}</span> </div></td>
                                            </tr>
                                            <tr>
                                                <td><b>Total à payer</b></td>
                                                <!--<td><div class="price-box"> <span class="price"><b>{{ $order->total }} {{ $basic->symbol }}</b></span> </div></td>-->
                                                <td><div class="price-box"> <span class="price"><b>{{ $order->total }} {{ $basic->symbol }}</b></span> </div></td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-sm-6">
                                <div class="cart-total-table address-box commun-table mb-30">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Adresse de livraison</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <li class="inner-heading">
                                                            <b>{{ $userDetails->s_name }}</b>
                                                        </li>
                                                        <li>
                                                            <p><!--{{ $userDetails->s_company }},--> {{ $userDetails->s_number }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->s_email }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->s_landmark }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->s_address }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->s_zip }}, {{ $userDetails->s_city }}, {{ $userDetails->s_state }}, {{ $userDetails->s_country }}</p>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="cart-total-table address-box commun-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Adresse de facturation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td style="padding: 13px">
                                                    <ul>
                                                        <li class="inner-heading">
                                                            <b>{{ $userDetails->b_name }}</b>
                                                        </li>
                                                        <li>
                                                            <p><!--{{ $userDetails->b_company }},--> {{ $userDetails->b_number }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->b_email }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->b_zip }}, {{ $userDetails->b_city }}, {{ $userDetails->b_state }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->b_country }}</p>
                                                        </li>
                                                    </ul>
                                                    <br>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div><a href="{{ route('home') }}" class="btn btn-block btn-color"><span><i class="fa fa-angle-left"></i></span>Continuer les achats</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->


@endsection
@section('scripts')


@endsection