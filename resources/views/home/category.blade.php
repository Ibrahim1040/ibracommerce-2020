@extends('layouts.fontEnd')
@section('content')


    <!-- Début de la bannière -->
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
    <!-- Fin de la bannière -->


    <!-- Début du contenu -->
    <section class="ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 mb-xs-30">
                    <div class="sidebar-block">
                        <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>Categories</h3>
                            </div>
                            <div class="sidebar-contant">
                                <ul>
                                    @foreach($category as $cat)
                                        <li><a href="{{ route('category',['id'=>$cat->id,'slug'=>str_slug($cat->name)]) }}"><i class="fa fa-link"></i>{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-box gray-box mb-40"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>Intervalle de prix</h3>
                            </div>
                            <div class="sidebar-contant">
                                <div class="price-range mb-30">
                                    <form action="{{ route('price-range') }}" method="get">
                                        <input class="price-txt" name="range_price" type="text" id="amount">
                                        <div id="slider-range"></div><br>
                                        <button type="submit" class="btn btn-color btn-block btn-sm" style="font-size: 16px">Filtre de prix</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="sidebar-title">
                        <h3>{{ $page_title }}</h3>
                    </div>
                    <div class="product-listing">
                        @if(count($product) != 0)
                        @foreach($product->chunk(3) as $fPro)
                            <div class="row mlr_-20">

                                @foreach($fPro as $fp)

                                    <div class="col-md-4 col-xs-6 plr-20">

                                        <div class="product-item {{ $fp->stock == 0 ? 'sold-out' : ''}}">
                                            <div class="sale-label"><span>Vente</span></div>
                                            <div class="product-image">
                                                <a href="{{ route('product-details',$fp->slug) }}"> <img src="{{ asset('assets/images/product') }}/{{ $fp->image }}" alt="{{ $fp->name }}"> </a>
                                                <div class="product-detail-inner">
                                                    <div class="detail-inner-left left-side">
                                                        <ul>
                                                            <li class="pro-cart-icon">
                                                                <button title="Ajouter au panier" class="SingleCartAdd" data-id="{{ $fp->id }}"><i class="fa fa-cart"></i></button>
                                                            </li>
                                                            <!-- <li class="pro-wishlist-icon active"><a href="#" title="Wishlist"></a></li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item-details">
                                                <div class="product-item-name"> <a href="{{ route('product-details',$fp->slug) }}">{{ substr($fp->name,0,65) }}</a> </div>
                                                <div class="price-box">
                                                    <span class="price">{{ $fp->current_price }} {{$basic->symbol}}</span>
                                                    @if($fp->old_price != null)
                                                        <del class="price old-price">{{ $fp->old_price }} {{$basic->symbol}}</del>
                                                    @endif
                                                    <div class=" right-side">
                                                        @php
                                                            $totalReview = \App\Review::whereProduct_id($fp->id)->count();
                                                            if ($totalReview == 0){
                                                                $finalRating = 0;
                                                            }else{
                                                                $totalRating = \App\Review::whereProduct_id($fp->id)->sum('rating');
                                                                $finalRating = round($totalRating / $totalReview);
                                                            }
                                                        @endphp
                                                        <div class="rating-result">
                                                            <span class="product-rating">
                                                                {!! \App\TraitsFolder\CommonTrait::viewRating($finalRating) !!}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <!--
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pagination-bar">
                                    {{ $product->links('home.pagination') }}
                                    
                                </div>
                            </div>
                        </div>
                        -->
                        @else
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="text-center" style="font-size: 24px;font-weight: bold;">Produit non trouvé..!</h2>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Fin du contenu -->

@endsection
@section('scripts')

    <script>
        $(document).ready(function() {

            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ "{{ $start_price }}" ,  "{{ $end_price }}" ],
                slide: function( event, ui ) {
                    $( "#amount" ).val(ui.values[ 0 ]+" {{ $basic->symbol }} - "+ ui.values[ 1 ]+"{{ $basic->symbol }}");
                }
            });
            $( "#amount" ).val(+$( "#slider-range" ).slider("values",0)+" {{ $basic->symbol }} - " +$( "#slider-range" ).slider( "values", 1)+" {{ $basic->symbol }}");
        });
    </script>

@endsection