@extends('frontend.layouts.app')
@section('meta_title','Pesan Pekerja')
@section('content')

    <section class="slice-xs sct-color-2 border-bottom">
        <div class="container container-sm">
            <div class="row cols-delimited justify-content-center">
                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center active">
                        <div class="block-icon mb-0">
                            <i class="la la-eye"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. {{__('Ringkasan')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-light mb-0">
                            <i class="la la-map-o"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. {{__('Diantar Kemana?')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon mb-0 c-gray-light">
                            <i class="la la-question"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. {{__('Apakah Sudah Benar?')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-light mb-0">
                            <i class="la la-truck"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">4. {{__('Konfirmasi')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-light mb-0">
                            <i class="la la-check-circle"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">5. {{__('Akhir Pesanan')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-4 gry-bg" id="cart-summary">
        <div class="container">
            @if(Session::has('cart'))
                <div class="row cols-xs-space cols-sm-space cols-md-space">

                <div class="col-xl-4 mx-lg-auto">
                    @include('frontend.partials.cart_summary')

                    <div class="row align-items-center pt-4">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="link link--style-3">
                                <i class="la la-mail-reply"></i>
                                {{__('Kembali')}}
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            @if(Auth::check())
                                <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{__('Pesan pekerja ini')}}</a>
                            @else
                                <button class="btn btn-styled btn-base-1" onclick="showCheckoutModal()">{{__('Pesan pekerja ini')}}</button>
                            @endif
                        </div>
                    </div>
                </div>

                
            </div>
            @else
                <div class="dc-header">
                    <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-user"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                    <br>
                                    <a href="{{ route('user.registration') }}" class="link link-xs link--style-3">{{__('Register Now')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                     @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 mt-3 text-center">
                            <span>or</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                            </a>
                            @endif
                        </div>
                    @endif
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>or</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{__('Guest Checkout')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }

    function updateQuantity(key, element){
        $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
        });
    }

    function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
    </script>
@endsection
