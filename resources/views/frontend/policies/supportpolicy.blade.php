@extends('frontend.layouts.app')
@section('meta_title','Mengapa harus kami')
@section('content')

    <style>
        .round {
            border-radius: 50%;
            width: 60%;
        }
    </style>

    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="p-4 bg-white">

                    <section class="section-team">
                        <div class="container">
                            <!-- Start Header Section -->
                            <div class="row justify-content-center text-center">
                                <div class="col-md-8 col-lg-6">
                                    <div class="header-section">
                                        <h3 class="small-title">Our Team from</h3>
                                        <img src="{{ asset('frontend/images/team/logocv.png') }}" class="img-fluid" alt="CV Nurcahya Aulia" width="50%">
                                        <h2 class="title">Let's meet with our team members</h2>
                                    </div>
                                </div>
                            </div>
                            <!-- / End Header Section -->
                            <div class="row justify-content-center text-center">

                                <div class="col-lg-3 col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('frontend/images/team/ibukiki.png') }}" class="img-fluid round mx-auto mt-5" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Kiki Rohayati</h5>
                                            <b class="cart-subtitle">Chief Executive Officer</b>
                                            <p class="card-text">she is an optimistic woman and always encourages everyone.</p>
                                        </div>
                                        <div class="card-body">
                                            <a href="https://api.whatsapp.com/send/?phone=6281319136439" class="card-link">Contact</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('frontend/images/team/payudi.png') }}" class="img-fluid round mx-auto mt-5" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Iswahyudi</h5>
                                            <b class="cart-subtitle">Chief Operating Officer</b>
                                            <p class="card-text">he is a man who always provides solutions for a process.</p>
                                        </div>
                                        <div class="card-body">
                                            <a href="https://api.whatsapp.com/send/?phone=6281319136439" class="card-link">Contact</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                
                                    <div class="card">
                                        <img src="{{ asset('frontend/images/team/ryan.png') }}" class="img-fluid round mx-auto mt-5">
                                        <div class="card-body">
                                            <h5 class="card-title">Ryan</h5>
                                            <b class="cart-subtitle">Programmer & Web Developer</b>
                                            <p class="card-text">the learner who always tries to give the best.</p>
                                        </div>
                                        <div class="card-body">
                                            <a href="https://api.whatsapp.com/send/?phone=628111091312" class="card-link">Contact</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="text-center text-secondary mt-4">
                                <h4>And others...</h4>
                            </div>

                        </div>
                    </section>
                        
                        @php
                            echo \App\Policy::where('name', 'support_policy')->first()->content;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
