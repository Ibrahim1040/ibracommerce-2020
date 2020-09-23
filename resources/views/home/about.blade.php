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


    <section class="ptb-50 ptb-xs-30 gray-bg">
        <div class="container">
            <div class="row testimonial">
                <div class="col-md-12">
                    <p>{!! $basic->about !!}</p>
                </div>
               
            </div>
        </div>
    </section>

    @if($testimonial_hide == 0)

    <section class="ptb-50 ptb-xs-30">
        <div class="container">
            <div class="row testimonial">
                <div id="testimonial_slider" class="text-center">
                    <div class="owl-carousel owl-theme">
                        @foreach($testimonial as $t)
                            <div class="item">
                                <div class="testimonial_header">
                                    <div>
                                        <img src="{{ asset('assets/images/testimonial') }}/{{ $t->image }}" style="width: 95px" class="center-block img-circle">
                                    </div>
                                    <h5>{{ $t->name }}</h5>
                                    <p>{{ $t->position }}</p>
                                </div>
                                <p>{{ $t->message }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection