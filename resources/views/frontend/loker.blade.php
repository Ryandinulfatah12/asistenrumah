@extends('frontend.layouts.app')
@section('meta_title','Lowongan Kerja')
@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-12 mx-auto">
                    <div class="main-content">

                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Lowongan Kerja')}}
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div id="accordion" class="mt-3">
                            
                            <div class="row">
                                @foreach (\App\Category::get() as $key => $category)
                                <div class="col-md-3">
                                    <div class="card">
                                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($category->banner) }}" alt="{{ __($category->name) }}" class="card-img-top lazyload img-fit">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $category->name }}</h5>
                                            <p class="card-text">{{ $category->meta_description }}</p>
                                            <a href="{{ route('products.category', $category->slug) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Pekerja terdaftar</a> <a href="https://api.whatsapp.com/send/?phone=628111091312&text=Permisi%20saya%20ingin%20menanyakan%20lowongan%20kerja" class="btn btn-success"><i class="fa fa-whatsapp" aria-hidden="true"></i> Tanya/Lamar pekerjaan</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
