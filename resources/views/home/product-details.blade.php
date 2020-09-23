@extends('layouts.fontEnd')
@section('meta')
    <meta name="keywords" content="{{ $product->tags }}">
    <meta name="description" content="{{ strip_tags($product->description) }}">
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('assets/images/product') }}/{{ $product->image }}" />
@endsection
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
    <section class="pt-50">
        <div class="container">
            <div class="row">
                <div class="col-md-3  mb-xs-30">
                    <div class="sidebar-block">
                        <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>catégories</h3>
                            </div>
                            <div class="sidebar-contant">
                                <ul>
                                    @foreach($category as $cat)
                                        <li><a href="{{ route('category',['id'=>$cat->id,'slug'=>str_slug($cat->name)]) }}"><i class="fa fa-link"></i>{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                   
                    <div class="sidebar-box gray-box mb-40"> <span class="opener plus"></span>
                        <div class="sidebar-title">
                            <h3>INTERVALLE DE PRIX</h3>
                        </div>
                        <div class="sidebar-contant">
                            <div class="price-range mb-30">
                                <form action="{{ route('price-range') }}" method="get">
                                    <input class="price-txt" name="range_price" type="text" id="amount">
                                    <div id="slider-range"></div><br>
                                    <button type="submit" class="btn btn-color btn-block btn-sm" style="font-size: 16px">Filtre prix</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 mb-xs-30">
                    <div class="fotorama" data-nav="thumbs" data-allowfullscreen="native">
                        @foreach($productImage as $pi)
                        <a href="#"><img src="{{ asset('assets/images/product') }}/{{ $pi->name }}" alt="{{ $product->name }}"></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 col-sm-7">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="product-detail-main">
                                <div class="product-item-details">
                                    <h1 class="product-item-name single-item-name">{{ $product->name }}</h1>
                                    <div class="rating-summary-block">
                                        <div class="rating-result single-rating">
                                            @php
                                                $totalReview = \App\Review::whereProduct_id($product->id)->count();
                                                if ($totalReview == 0){
                                                    $finalRating = 0;
                                                }else{
                                                    $totalRating = \App\Review::whereProduct_id($product->id)->sum('rating');
                                                    $finalRating = round($totalRating / $totalReview);
                                                }
                                            @endphp
                                            <p>
                                                <span class="review_score">{{ $finalRating }}/5</span>{!! \App\TraitsFolder\CommonTrait::viewRating($finalRating) !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="price-box"> <span class="price">{{ $product->current_price }} {{ $basic->symbol }}</span> @if($product->old_price != null)<del class="price old-price bold">{{ $product->old_price }} {{ $basic->symbol }}</del>@endif</div>
                                    <div class="product-info-stock-sku">
                                        <div>
                                            <label>Disponibilitè: </label>
                                            @if($product->stock == 0)
                                                <span style="color:red" class="info-deta">Non disponible</span>
                                            @elseif($product->stock < 10)
                                                <span style="color:orange" class="info-deta">Faible disponibilité</span>
                                            @else
                                                <span style="color:green" class="info-deta">En stock</span>
                                            @endif
                                        </div>
                                        <div>
                                            <label>SKU: </label>
                                            <span class="info-deta">{{ $product->sku }}</span> </div>
                                    </div>
                                    <div class="product-info-stock-sku">
                                        <div>
                                            <label>Spécification de produit: </label>
                                            <hr>
                                            <br>
                                            @foreach($productSpecification as $ps)
                                                <p>{{ $ps->specification }}</p>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mb-40">
                                        <form action="" method="post">
                                            {!! csrf_field() !!}
                                            <div class="product-qty">
                                                <label for="qty">Qté:</label>
                                               <h2>
                                               <div class="custom-qty">
                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>
                                                    <input type="text" class="input-text qty" title="Qty" value="1" max="{{ $product->stock }}" id="qty" name="qty" required>
                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>
                                                </div>
                                               </h2>
                                            </div>
                                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                            <div class="bottom-detail cart-button">
                                                <ul>
                                                    <li class="pro-cart-icon">
                                                        <button type="button" title="Ajouter au panier" class="btn-black addCart"><span></span>Ajouter au panier</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="share-link">
                                        <div class="social-link">
                                            <div class="sharethis-inline-share-buttons st-inline-share-buttons  st-left st-has-labels st-animated" id="st-1">
                                                <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section class="ptb-50">
        <div class="container">
            <div class="product-detail-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div id="tabs">
                            <ul class="nav nav-tabs">
                                <!-- <li><a class="tab-Description selected" title="Description">Description</a></li> -->
                                <!-- <li><a class="tab-Product-Tags" title="Product-Tags">Product-Tags</a></li> -->
                                <li><a class="tab-Reviews selected" title="Reviews">Commentaires</a></li>
                                <!-- <li><a class="tab-Comments" title="Comments">Comments</a></li> -->
                            </ul>
                        </div>
                        <div id="items">
                            <div class="tab_content">
                                <ul>
                                    <li>
                                        <div class="items-Reviews selected gray-bg">
                                            <div class="comments-area">
                                                <h3 class="form-label">Commentaires <span>({{ count($productReviews) }})</span></h3>
                                                <ul class="comment-list mt-30">
                                                    @foreach($productReviews as $rv)
                                                    <li>
                                                        <div class="comment-user">
                                                            <img class="img-circle" width="80%" src="{{ asset('assets/images/user') }}/{{ $rv->user->image }}" alt="{{ $rv->user->name }}"> </div>
                                                        <div class="comment-detail">
                                                            <div class="user-name">{{ $rv->user->first_name }} {{ $rv->user->last_name }}</div>
                                                            <div class="post-info">
                                                                <ul>
                                                                    <li>{{ \Carbon\Carbon::parse($rv->created_at)->format('d M, Y - h:i A')  }}</li>
                                                                </ul>
                                                            </div>
                                                            <p style="margin-bottom: 0px">{!! \App\TraitsFolder\CommonTrait::viewRating($rv->rating) !!} - <span class="review_score">{{ $rv->rating }}/5</span></p>
                                                            <p>{{ $rv->comment }}</p>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="main-form mt-30">
                                                <div class="row">
                                                    @if(Auth::check())

                                                        @php $userReviewCount = \App\Review::whereUser_id(Auth::user()->id)->whereProduct_id($product->id)->count();@endphp

                                                        @if($userReviewCount != 0)
                                                            @php $userReview = \App\Review::whereUser_id(Auth::user()->id)->whereProduct_id($product->id)->first();@endphp
                                                            <div class="comments-area">
                                                                <h3 class="form-label">Votre avis</h3>
                                                                <ul class="comment-list mt-30">
                                                                    <li>
                                                                        <div class="comment-user">
                                                                            <img class="img-circle" width="80%" src="{{ asset('assets/images/user') }}/{{ $userReview->user->image }}" alt="{{ $userReview->user->name }}"> </div>
                                                                        <div class="comment-detail">
                                                                            <div class="user-name">{{ $userReview->user->first_name }} {{ $userReview->user->last_name }}</div>
                                                                            <div class="post-info">
                                                                                <ul>
                                                                                    <li>{{ \Carbon\Carbon::parse($userReview->created_at)->format('M d, Y - h:i:s A')  }}</li>
                                                                                </ul>
                                                                            </div>
                                                                            <p style="margin-bottom: 0px">{!! \App\TraitsFolder\CommonTrait::viewRating($userReview->rating) !!} - <span class="review_score">{{ $rv->rating }}/5</span></p>
                                                                            <p>{{ $userReview->comment }}</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @else
                                                        <form action="{{ route('review-submit') }}" method="post">
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Évaluation pour le produit</label>
                                                                    <div class="listing_rating">
                                                                        <input name="rating" id="rating-5" value="5" type="radio" required="">
                                                                        <label for="rating-5" class="fa fa-star"></label>
                                                                        <input name="rating" id="rating-4" value="4" type="radio" required="">
                                                                        <label for="rating-4" class="fa fa-star"></label>
                                                                        <input name="rating" id="rating-3" value="3" type="radio" required="">
                                                                        <label for="rating-3" class="fa fa-star"></label>
                                                                        <input name="rating" id="rating-2" value="2" type="radio" required="">
                                                                        <label for="rating-2" class="fa fa-star"></label>
                                                                        <input name="rating" id="rating-1" value="1" type="radio" required="">
                                                                        <label for="rating-1" class="fa fa-star"></label>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Commentaire d'évaluation</label>
                                                                    <textarea cols="30" rows="3" name="comment" placeholder="Message" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 mb-30">
                                                                <button class="btn-color btn-block" type="submit">Soumettre</button>
                                                            </div>
                                                            <div class="col-xs-6 mb-30">
                                                                <button class="btn-danger btn-block" style="border: none" type="reset">Supprimer</button>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    @else
                                                        <form action="{{ route('login') }}" method="post">
                                                            {!! csrf_field() !!}
                                                            <div class="col-xs-12 mb-20">
                                                                <div class="sidebar-title">
                                                                    <h3>Besoin de connexion</h3>
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
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Adresse e-mail</label>
                                                                    <input id="login-email" name="email" type="email" value="{{ old('email') }}" required placeholder="Adresse e-mail">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Mot de passe</label>
                                                                    <input id="login-pass" name="password" type="password" required placeholder="Tapez votre mot de passe">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 mb-30">
                                                                <button class="btn-color btn-block" type="submit">S'identifier</button>
                                                            </div>
                                                            <div class="col-xs-6 mb-30">
                                                                <button class="btn-danger btn-block" style="border: none" type="reset">Réinitialiser</button>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="new-account align-center mt-20"> <span>Besoin d'un nouveau compte?</span> <a class="link" title="Register" href="{{ route('register') }}">Créer un nouveau compte</a> </div>
                                                            </div>
                                                        </form>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                   

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="pb-95">
        <div class="container">
            <div class="product-slider">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="heading-part mb-20">
                            <h2 class="main_title">Produits similaires</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product-slider-main position-r"><!-- dresses -->
                        <div class="owl-carousel pro_rel_slider"><!-- id="product-slider" -->
                            @foreach($relatedProduct as $rp)
                            <div class="item">
                                <div class="product-item">
                                    <div class="sale-label"><span>Vente</span></div>
                                    <div class="product-image"> <a href="{{ route('product-details',$rp->slug) }}"> <img src="{{ asset('assets/images/product') }}/{{ $rp->image }}" alt="{{ $rp->name }}"> </a>
                                        <div class="product-detail-inner">
                                            <div class="detail-inner-left left-side">
                                                <ul>
                                                    <li class="pro-cart-icon">
                                                        <form>
                                                            <button title="Add to Cart"></button>
                                                        </form>
                                                    </li>
                                                    <!-- <li class="pro-wishlist-icon"><a href="#" title="Wishlist"></a></li> -->
                                                    <li class="pro-compare-icon"><a href="#" title="Compare"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item-details">
                                        <div class="product-item-name"> <a href="{{ route('product-details',$rp->slug) }}">{{ substr($rp->name,0,65) }}</a> </div>
                                        <div class="price-box">
                                            <span class="price">{{ $rp->current_price }} {{$basic->symbol}}</span> @if($product->old_price != null)<del class="price old-price bold">{{ $rp->old_price }} {{ $basic->symbol }}</del>@endif
                                            <div class="rating-summary-block right-side">
                                                <div title="53%" class="rating-result"> <span style="width:53%"></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->

    <div id="email_friends_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h3 class="modal-title ">E-mail à vos amis</h3>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!!  $error !!}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('submit-friend-email') }}" method="post" role="form" >
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input class="form-control" name="name" placeholder="Votre Nom" type="text" data-error="Veuillez entrer le champ du nom." required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="ownEmail" placeholder="Votre adresse email " type="email" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="friendEmail" placeholder="Adresse email de votre ami " type="email" required>
                        </div>
                        <input type="hidden" name="url" value="{{ url()->current() }}">
                        <div class="form-group">
                            <input value="Submit" class="btn btn-block btn-primary btn-color" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')

    <script>
        $(document).ready(function() {

            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ 180, 800 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val(ui.values[ 0 ]+" {{ $basic->symbol }}-" + ui.values[ 1 ]+" {{ $basic->symbol }}");
                }
            });
            $( "#amount" ).val($( "#slider-range" ).slider("values",0)+ " {{ $basic->symbol }}-"+$( "#slider-range" ).slider( "values", 1)+" {{ $basic->symbol }}");
        });
    </script>
    <script>

        var url = '{{ url('/add-to-cart') }}';

        $(".addCart").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            e.preventDefault();
            var formData = {
                product_id: $('#product_id').val(),
                qty: $('#qty').val()
            };
            var type = "POST";
            var my_url = url;
            console.log(formData);
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result['cartError'] == "yes"){
                        toastr.warning(result['cartErrorMessage']);
                    }else{
                        toastr.success('Produit ajouté au panier.');
                        $('#cartShow').empty();
                        $('#cartShow').append(result['cartShowFinal']);
                    }
                },
                error: function(data)
                {
                    $.each( data.responseJSON.errors, function( key, value ) {
                        toastr.error( value);
                    });
                }
            });
        });


    </script>

@endsection