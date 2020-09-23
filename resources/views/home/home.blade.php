@extends('layouts.fontEnd')
@section('style')

@endsection
@section('content')


    <!-- Début de la bannière -->
    <div class="banner">
        <div class="row">
            <div class="col-xs-12">
                <div class="main-banner">
                    @foreach($slider as $sli)
                    <div class="item"> <img src="{{ asset('assets/images/slider') }}/{{ $sli->image }}" alt="MarketShop">
                        <div class="banner-detail">
                            <div class="container">
                                <div class="banner-detail-inner">
                                    <h1 class="banner-title">{{ $sli->main_title }}</h1>
                                    <span class="slogan">{{ $sli->sub_title }}</span><br>
                                    <p>{{ $sli->short_title }}</p>
                                    <a href="{{ route('cart') }}" class="btn btn-color">Achetez maintenant</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la bannière -->
    <!--  Fonctionnalités des services de site Début de bloc  -->
    <section class="pt-50 pt-xs-30">
        <div class="container">
            <div class="ser-feature-block center-sm" style="background-image: url('{{ asset('assets/images/speciality') }}/{{ $basic->speciality_bg }}')">
                <div class="row">
                    @foreach($speciality as $sp)
                    <div class="col-md-3 col-xs-6 feature-box-main">
                        <div class="feature-box feature1" style="background: url('{{ asset('assets/images/speciality') }}/{{ $sp->image }}') no-repeat scroll 0 0;filter: brightness(0) invert(1);">
                            <div class="ser-title">{{ $sp->title }}</div>
                            <div class="ser-subtitle">{{ $sp->subtitle }}</div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--  Fonctionnalités du site: fin de bloc  -->

    <!-- Début du contenu -->
    <section class="ptb-50 ptb-xs-30">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 mb-xs-30">
                    <div class="sidebar-block">
                        <div class="sidebar-box listing-box mb-30"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>Categories</h3>
                            </div>
                            <div class="sidebar-contant">
                                <ul>    
                                    @foreach($menubarCat as $cat)
                                    <li><a href="{{ route('category',['id'=>$cat->id,'slug'=>str_slug($cat->name)]) }}"><i class="fa fa-link"></i>{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                       
                        <div class="sidebar-box gray-box mb-40"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>intervalle de prix</h3>
                            </div>
                            <div class="sidebar-contant">
                                <div class="price-range mb-30">
                                    <form action="{{ route('price-range') }}" method="get">
                                        <input class="price-txt" name="range_price" type="text" id="amount">
                                        <div id="slider-range"></div><br>
                                        <button type="submit" class="btn btn-color btn-block btn-sm" style="font-size: 16px">Filtrer par prix</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="product-slider mb-40">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <div id="tabs" class="category-bar mb-20 p-0">
                                        <ul class="tab-stap">
                                            <li><a class="tab-step1 selected" title="step1">Nos Produits </a></li>
                                            <!--<li><a class="tab-step2" title="step2">Meilleures ventes</a></li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product">
                            <div class="items">
                                <div class="tab_content pro_cat">
                                    <ul>
                                        <li>
                                            <div id="data-step1" class="items-step1 selected product-slider-main position-r" data-temp="tabdata">
                                                @foreach($latestProduct->chunk(3) as $fPro)
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
                                                                            <!-- <li class="pro-wishlist-icon active"><a class="SingleWishList" data-id="{{ $fp->id }}" title="Wishlist"></a></li> -->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-item-details">
                                                                <div class="product-item-name"> <a href="{{ route('product-details',$fp->slug) }}">{{ substr($fp->name,0,65) }}</a> </div>
                                                                <div class="price-box">
                                                                    <span class="price">{{ $fp->current_price }} {{$basic->symbol}} HTVA </span>
                                                                    @if($fp->old_price != null)
                                                                    <del class="price old-price">{{ $fp->old_price }}{{$basic->symbol}}</del>
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

                                                <!-- affiche la pagination de laravel -->
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="pagination-bar">
                                                            {!! $latestProduct->links('home.pagination') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- fin de pagination -->
                                                
                                            </div>
                                        </li>
                                         <!-- 
                                        <li>                                  
                                            <div id="data-step2" class="items-step2 product-slider-main position-r" data-temp="tabdata" style="display:none">
                                                @foreach($bestSell->chunk(3) as $fPro)
                                                    <div class="row mlr_-20">

                                                        @foreach($fPro as $ffp)
                                                            
                                                            @php $fp = \App\Product::find($ffp->product_id) @endphp
                                                            @if($fp != null)                         
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
                                                                                     <li class="pro-wishlist-icon active"><a class="SingleWishList" data-id="{{ $fp->id }}" title="Wishlist"></a></li>
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
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                @endforeach
                                                
                                                 pagination meilleures ventes 
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="pagination-bar">
                                                            {!! $bestSell->links('home.pagination') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </li>
                                        -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
                           
    </section>
    <!-- Fin du contenu  -->

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ 0,1000 ],

                slide: function( event, ui ) {
                    $( "#amount" ).val(ui.values[ 0 ]+"{{ $basic->symbol }} - " + ui.values[ 1 ] + " {{ $basic->symbol }}");
                }
            });
            $( "#amount" ).val($( "#slider-range" ).slider("values",0)+ " {{ $basic->symbol }} -" +$( "#slider-range" ).slider( "values", 1) + " {{ $basic->symbol }}");
        });
    </script>
@endsection