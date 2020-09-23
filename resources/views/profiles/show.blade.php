<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="fr">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @if($meta_status == 1 )
        <meta name="keywords" content="{{ $basic->meta_tag }}">
        <meta name="description" content="{{ $basic->title }}">
        <meta property="og:title" content="{{ $basic->title }}" />
        <meta property="og:url" content="{{ url('/') }}" />
        <meta property="og:image" content="{{ asset('assets/images/logo.png') }}" />
    @else
        @yield('meta')
    @endif
    <title>Bienvenue</title>

    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
      ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fotorama.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color.php') }}?color={{ $basic->color }}">
    @yield('style')
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
</head>
<body>
<div class="se-pre-con"></div> 

<div class="main">
    <!-- HEADER START -->
    <header class="navbar navbar-custom" id="header">
        <div class="header-middle">
            <div class="container">
                <hr>
                <div class="header-inner">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="navbar-header">
                                <a class="navbar-brand page-scroll" href="{{ route('home') }}"> <img alt="{{ $basic->title }}" src="{{ asset('assets/images/logo.png') }}"> </a>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-6">
                            <div class="right-side">
                                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><i class="fa fa-bars"></i></button>
                                <div class="right-side float-left-xs header-right-link">
                                    <div class="main-search">
                                        <div class="header_search_toggle desktop-view">
                                            <form action="{{ route('search-product') }}" method="get" >
                                                <div class="search-box" style="margin-top: 6px;">
                                                    <input class="input-text" type="text" name="name" placeholder="Rechercher un produit...">
                                                    <button class="search-btn"></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6" style="margin-top: 6px;" >
                        <div class="top-link right-side">
                            <ul>
                                <!-- <li>
                                    <a href="{{ route('wishlist') }}" title="Wishlish">
                                        <i class="fa fa-heart hidden-sm hidden-lg" aria-hidden="true"></i>
                                        <span class="hidden-xs">Wishlist</span>
                                    </a>
                                </li> -->

                                @if(Auth::check())
                                    <li>
                                        <div class="btn-group show-on-hover">
                                        <span class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 10px">
                                            &nbsp;Bonjour {{ Auth::user()->first_name }} <span class="caret"></span>
                                        </span>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ route('user-all-order') }}"><i class="fa fa-shopping-cart"></i>Mes commandes</a></li>
                                                <li><a href="{{ route('user-edit-profile') }}"><i class="fa fa-edit"></i> Editer mon profil</a></li>
                                                <li><a href="{{ route('user-change-password') }}"><i class="fa fa-send"></i>Mettre à jour mon mot de passe</a></li>
                                                <li class="divider"></li>
                                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Se déconnecter</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                <li>
                                    <a href="{{ route('login') }}" title="Login">
                                        <i class="fa fa-lock hidden-sm hidden-lg" aria-hidden="true"></i>
                                        <span class="hidden-xs">Login</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header_search_toggle mobile-view">
                                <form>
                                    <div class="search-box">
                                        <input class="input-text" type="text" placeholder="Rechercher un produit ...">
                                        <button class="search-btn"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="container">
            <div class="header-bottom">
                <div class="">
                    <div id="menu" class="navbar-collapse collapse left-side p-0">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="level"><a href="{{ route('home') }}" class="page-scroll">Accueil</a></li>
                            @foreach($menubarCat as $mcat)
                            <li class="level">
                                <span class="opener plus"></span>
                                <a href="{{ route('category',['id'=>$mcat->id,'slug'=>str_slug($mcat->name)]) }}" class="page-scroll">{{ $mcat->name }}</a>
                                <div class="megamenu full mobile-sub-menu">
                                    <div class="megamenu-inner">
                                        <div class="megamenu-inner-top">
                                            <div class="row">
                                                @php $mSubCat = \App\Subcategory::whereCategory_id($mcat->id)->get() @endphp
                                                @foreach($mSubCat->chunk(4) as $chunkSubcat)
                                                    @foreach($chunkSubcat as $cc)
                                                        <div class="col-md-3 level2">
                                                            <a href="{{ route('subcategory',['id'=>$cc->id,'slug'=>str_slug($cc->name)]) }}"><span>{{ $cc->name }}</span></a>
                                                            <ul class="sub-menu-level2 ">
                                                                @php $menuChildCat = \App\ChildCategory::wheresubcategory_id($cc->id)->get() @endphp
                                                                @foreach($menuChildCat as $mChildCat)
                                                                    <li class="level3"><a href="{{ route('childcategory',['id'=>$mChildCat->id,'slug'=>str_slug($mChildCat->name)]) }}">{{ $mChildCat->name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            <li class="level"><a href="{{ route('contact-us') }}" class="page-scroll">Contact</a></li>
                        </ul>
                        <div class="header_search_toggle mobile-view">
                            <form>
                                <div class="search-box">
                                    <input class="input-text" type="text" placeholder="Rechercher un produit ...">
                                    <button class="search-btn"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right-side float-left-xs header-right-link">
                        <ul id="cartShow">
                            <li class="cart-icon">
                                <a href="#">
                                    <span> <small class="cart-notification">{{ Cart::count() }}</small> </span>
                                    <div class="cart-text hidden-sm hidden-xs">Panier</div>
                                </a>
                                <div class="cart-dropdown header-link-dropdown">
                                    <ul class="cart-list link-dropdown-list">
                                        @foreach(Cart::content() as $cont)
                                        <li>
                                            <a data-id="{{ $cont->rowId }}" class="close-cart delete_cart"><i class="fa fa-times-circle"></i></a>
                                            <div class="media">
                                                <a class="pull-left"> <img alt="{{ $cont->name }}" src="{{ asset('assets/images/product') }}/{{ $cont->options->image }}"></a>
                                                <div class="media-body"> <span><a>{{ substr($cont->name,0,25) }}..</a></span>
                                                    <p class="cart-price">{{ $cont->price }} {{ $basic->symbol }} x {{ $cont->qty }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <p class="cart-sub-totle"> <span class="pull-left">Sous total</span> <span class="pull-right"><strong class="price-box">{{ Cart::subtotal() }} {{ $basic->symbol }}</strong></span> </p>
                                    <div class="clearfix"></div>
                                    <div class="mt-20"> <a href="{{ route('cart') }}" class="btn-color btn">Panier</a> <a href="{{ route('check-out') }}" class="btn-color btn right-side">Commande</a> </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="menu-shadow-btm"><img src="{{ asset('assets/images/menu-shadow.png') }}" alt="MarketShop"></div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->

    @yield('content')


<!-- Brand logo block Start  -->
    
    <!-- Brand logo block End  -->

  
</div>
<script src="{{ asset('assets/js/jquery-1.12.3.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/fotorama.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
 <script src="{{ asset('assets/admin/js/toastr.js') }}"></script>
@yield('scripts')
<script>

    $(document).ready(function () {
        $(document).on("click", '.delete_cart', function (e) {
            var rowId = $(this).data('id');
            $.post(
                    '{{ url('/delete-cart-item') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        rowId : rowId
                    },
                    function(data) {
                        var result = $.parseJSON(data);
                        toastr.success('Produit supprimé du panier.');
                        $('#cartShow').empty();
                        $('#cartShow').append(result['cartShow']);
                        $('#cartFullView').empty();
                        var div = document.getElementById('cartFullView');
                        div.innerHTML = result['fullShow'];
                    }

            );
        });
        $(document).on("click", '.SingleCartAdd', function (e) {
            var id = $(this).data('id');
            $.post(
                '{{ url('/single-cart-add') }}',
                {
                    _token: '{{ csrf_token() }}',
                    id : id
                },
                function(data) {
                    toastr.success('Produit ajouté au panier.');
                    $('#cartShow').empty();
                    $('#cartShow').append(data);
                }
            );
        });
        $(document).on("click", '.SingleWishList', function (e) {
            var id = $(this).data('id');
            $.post(
                    '{{ url('/single-wishlist-add') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        id : id
                    },
                    function(data) {
                        var result = $.parseJSON(data);
                        if (result['cartError'] == "yes"){
                            toastr.warning(result['cartErrorMessage']);
                        }else if(result['cartError'] == "exist"){
                            toastr.info(result['cartErrorMessage']);
                        }else {
                            toastr.success(result['cartErrorMessage']);
                        }
                    }
            );
        });
    });

</script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
{!! $basic->google_analytic !!}
{{-- {!! $basic->chat !!} --}}


</body>

</html>


