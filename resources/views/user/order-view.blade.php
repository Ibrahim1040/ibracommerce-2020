@extends('layouts.fontEnd')
@section('content')


    <!-- BANNER STRAT -->
    <div class="banner inner-banner align-center" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}');">
        <div class="container">
            <section class="banner-detail">
                <h1 class="banner-title">{{ $page_title }}</h1>
                <div class="bread-crumb right-side">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a>/</li>
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

                    <div class="checkout-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="heading-part align-center">
                                    <h2 class="heading">N° Commande : #{{$order->order_number}}</h2>
                                </div>
                            </div>
                        </div>
                        <div id="cartFullView" class="row">
                            <div class="col-xs-12 mb-xs-30">
                                <div class="sidebar-title">
                                    <h3>Produits achetés</h3>
                                </div>
                                <div class="cart-item-table commun-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Nom</th>
                                                <th>Prix</th>
                                                <th>Sous-total</th>
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
                                                                <div class="base-price price-box"> <span class="price">{{ $con->qty }} x {{ $order->subtotal }} {{ $basic->symbol }}</span> </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <div class="total-price price-box"> <span class="price">{{ $order->subtotal * $con->qty }} {{ $basic->symbol }}</span> </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="cart-total-table commun-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered custom-table">
                                            <tbody>
                                            <tr>
                                                <td class="text-right" width="50%">Statut du paiment</td>
                                                <td class="text-left">
                                                    <div class="price-box custom-table">
                                                        @if($order->payment_status == 0)
                                                            <span class="label label-warning"><i class="fa fa-spinner"></i> En attente</span> {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                                        @else
                                                            <span class="label label-success"><i class="fa fa-check"></i> Payée</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" width="50%">Statut de la livraison</td>
                                                <td class="text-left">
                                                    @if($order->shipping_status == 0)
                                                        <span class="label label-danger"><i class="fa fa-times"></i> Non traitée</span>
                                                    @elseif($order->shipping_status == 1)
                                                        <span class="label label-warning"><i class="fa fa-spinner"></i> En attente</span>
                                                    @elseif($order->shipping_status == 2)
                                                        <span class="label label-danger"><i class="fa fa-times"></i> Annulée</span>
                                                    @else
                                                        <span class="label label-success"><i class="fa fa-check"></i> Confirmée</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><b>Statut de la commande</b></td>
                                                <td class="text-left">
                                                    <div class="price-box">
                                                        <div class="product-title">
                                                            @if($order->status == 0)
                                                                <span class="label label-warning"><i class="fa fa-spinner"></i> En attente</span>
                                                            @elseif($order->status == 1)
                                                                <span class="label label-success"><i class="fa fa-check"></i> Confirmée</span>
                                                            @else
                                                                <span class="label label-danger"><i class="fa fa-times"></i> Annulée</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="cart-total-table commun-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>Sous total</td>
                                                <td><div class="price-box"> <span class="price">{{ $order->subtotal }} {{ $basic->symbol }}</span> </div></td>
                                            </tr>
                                            <tr>
                                                <td>TVA - {{ $basic->tax }}% </td>
                                                <td><div class="price-box"> <span class="price">{{ $order->tax }} {{ $basic->symbol }}</span> </div></td>
                                            </tr>
                                            <tr>
                                                <td><b>Montant payable</b></td>
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
                                                <th>Adresse livraison</th>
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
                                                            <p>Adresse : {{ $userDetails->s_address }}</p>
                                                        </li>
                                                        <li>
                                                            <p>{{ $userDetails->s_zip }}, {{ $userDetails->s_city }}, {{ $userDetails->s_state }}, {{ $userDetails->s_country }}</p>
                                                        </li>
                                                        <li>
                                                            <p>E-mail : {{ $userDetails->s_email }}</p>
                                                        </li>
                                                        <li>
                                                            <p>Numéro de téléphone : {{ $userDetails->s_number }}</p>
                                                        </li>                                                      
                                                        <li>
                                                            <p>En cas d'absence : {{ $userDetails->s_landmark }}</p>
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
                                                <th> Adresse Facturation</th>
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
                                                            <p>{{ $userDetails->b_company }} {{ $userDetails->b_number }}</p>
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
                                <div><a href="{{ route('home') }}" class="btn btn-block btn-color"><span><i class="fa fa-angle-left"></i></span>Retour page d'accueil</a> </div>
                            </div>
                            <!--
                            <div class="col-sm-6">
                            <div><a href="{{ route('home') }}" class="btn btn-block btn-color">Imprimer facture en pdf<span><i class="fa fa-angle-right"></i></span></a></div>
                            </div>
                            -->
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