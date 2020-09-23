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
    <section class="ptb-50">
        <div class="container">
            <div id="cartFullView" class="row mb-30">
                <div class="col-xs-12 mb-xs-30">
                    <div class="sidebar-title">
                        <h3>{{ $page_title }}</h3>
                    </div>
                    <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                     <th> Produit </th>
                                     <th> Nom du produit </th>
                                     <th> Prix </th>
                                     <th> Quantité </th>
                                     <th> Sous total </th>
                                     <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $con)
                                    @php $product = \App\Product::findOrFail($con->id) @endphp
                                    <tr id="product_{{$con->rowId}}">
                                        <td>
                                            <a href="{{ route('product-details',$product->slug) }}">
                                                <div class="product-image"><img alt="{{ $con->name }}" src="{{ asset('assets/images/product') }}/{{$con->options->image}}"></div>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="product-title">
                                                <a href="{{ route('product-details',$product->slug) }}">{{ $con->name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <div class="base-price price-box"> <span class="price">{{ $con->price }} {{$basic->symbol}}</span> </div>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="input-box">
                                                <div class="custom-qty">
                                                    <button id="btnMinus{{$con->rowId}}" onclick="var result = document.getElementById('qty{{ $con->id }}'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>
                                                    <input type="text" class="input-text qty" readonly title="Qty" value="{{ $con->qty }}" maxlength="{{ $product->stock }}" id="qty{{ $con->id }}" name="qty{{ $con->id }}">
                                                    <button id="btnPlus{{$con->rowId}}" onclick="var result = document.getElementById('qty{{ $con->id }}'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="total-price price-box"> <span class="price">{{ $con->price * $con->qty  }} {{$basic->symbol}}</span> </div></td>
                                        <td><i title="Supprimer l'article du panier" data-id="{{ $con->rowId }}" class="fa fa-trash delete_cart cart-remove-item"></i></td>
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
                                    <td><div class="price-box"> <span class="price">{{ Cart::subtotal() }} {{ $basic->symbol }}</span> </div></td>
                                </tr>
                                <tr>
                                    <td>Tva {{ $basic->tax }} % </td>
                                    <td><div class="price-box"> <span class="price">{{ Cart::tax() }} {{ $basic->symbol }}</span> </div></td>
                                </tr>
                                <tr>
                                    <td><b>Montant à payer</b></td>
                                    <td><div class="price-box"> <span class="price"><b>{{ Cart::total() }} {{ $basic->symbol }}</b></span> </div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mb-30">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mt-30"> <a href="{{ route('home') }}" class="btn btn-color"><span><i class="fa fa-angle-left"></i></span>Continuez les achats</a> </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mt-30 right-side float-none-xs"> <a href="{{ route('check-out') }}" class="btn btn-color">procédez au règlement<span><i class="fa fa-angle-right"></i></span></a> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->


@endsection
@section('scripts')

    @foreach(Cart::content() as $con)

        <script>
            var url = '{{ url('/') }}';
            $(document).ready(function () {
                $(document).on("click", '#btnMinus{{$con->rowId}}', function (e) {
                    var qty = $('#qty{{ $con->id }}').val();
                    $.get(url + '/update-cart-item/' + '{{ $con->rowId }}'+'/'+qty,function (data) {
                        var result = $.parseJSON(data);
                        if (result['cartError'] == "yes"){
                            toastr.warning(result['cartErrorMessage']);
                        }else{
                            toastr.success('Panier mis à jour avec succès.');
                            $('#cartShow').empty();
                            $('#cartShow').append(result['cartShow']);
                            $('#cartFullView').empty();
                            var div = document.getElementById('cartFullView');
                            div.innerHTML = result['fullShow'];
                        }
                    });
                });
                $(document).on("click", '#btnPlus{{$con->rowId}}', function (e) {
                    var qty = $('#qty{{ $con->id }}').val();
                    $.get(url + '/update-cart-item/' + '{{ $con->rowId }}'+'/'+qty,function (data) {
                        var result = $.parseJSON(data);
                        if (result['cartError'] == "yes"){
                            toastr.warning(result['cartErrorMessage']);
                        }else{
                            toastr.success('Panier mis à jour avec succès.');
                            $('#cartShow').empty();
                            $('#cartShow').append(result['cartShow']);
                            $('#cartFullView').empty();
                            var div = document.getElementById('cartFullView');
                            div.innerHTML = result['fullShow'];
                        }
                    });
                });

            });
        </script>

    @endforeach

@endsection