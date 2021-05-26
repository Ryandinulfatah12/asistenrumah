@extends('frontend.layouts.app')
@section('meta_title','Dashboard')
@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        @if(session('status') == 1)
                        <div class="alert alert-success" role="alert">
                          Selamat Datang, <b>{{Auth::user()->name}}</b> Dipersilahkan anda untuk melihat Daftar Asisten/Perawat tersedia di Website AsistenRumah.com. <i class="fa fa-hand-o-right" aria-hidden="true"></i><a href="{{route('home')}}" class="alert-link">Lihat Daftar Pekerja</a>
                        </div>
                        @endif
                        <!-- JIKA MEMBER DAFTAR -->
                        @if(session('status') == 'success')
                        <div class="alert alert-warning" role="alert">
                          <h4 class="alert-heading">Langkah selanjutnya!</h4>
                          <p>Terimakasih..Anda telah terdaftar menjadi bagian dari Keluarga AsistenRumah.com, langkah yang perlu anda lakukan adalah melengkapi data anda seperti Alamat, Telp, dan Kode Pos anda.</p>

                          <b>Apa yang saya dapatkan dengan Bergabung AsistenRumah.com ?</b>
                            <ul class="list-group">
                              <li class="list-group-item text-success">- Konsultasi dengan Respon cepat.</li>
                              <li class="list-group-item text-primary">- Memesan Asisten Rumah dengan Aman dan Nyaman.</li>
                              <li class="list-group-item text-warning">- Asisten Rumah dari Penyalur-penyalur yang sudah Terjamin Legalitasnya</li>
                              <li class="list-group-item text-danger">- Keamanan dan Enkripsi data</li>
                              <li class="list-group-item text-dark">- Informasi Pekerja Asli dilihatkan hanya untuk Member Terdaftar</li>
                            </ul>
                          <hr>

                          <b class="text-danger">Tertarik berlangganan di AsistenRumah.com?</b>
                          <a class="btn btn-success" href="https://api.whatsapp.com/send/?phone=628111091312&text=%22Halo%20Admin%20AsistenRumah.com%20saya%20perlu%20bantuan%20nih..%22"><i class="fa fa-whatsapp" aria-hidden="true"></i> Tanyakan Sesuatu ke CS</a>
                        </div>
                        @endif

                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Dashboard')}}
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-eye"></i>
                                        @if(Session::has('cart'))
                                            <span class="d-block title">{{ count(Session::get('cart'))}} {{__('Product(s)')}}</span>
                                        @else
                                            <span class="d-block title">0 {{__('Pekerja')}}</span>
                                        @endif
                                        <span class="d-block sub-title">{{__('didalam Draft')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center red-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-heart"></i>
                                        <span class="d-block title">{{ count(Auth::user()->wishlists)}} {{__('Pekerja')}}</span>
                                        <span class="d-block sub-title">{{__('di wishlistmu')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-building"></i>
                                        @php
                                            $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orders as $key => $order) {
                                                $total += count($order->orderDetails);
                                            }
                                        @endphp
                                        <span class="d-block title">{{ $total }} {{__('Pekerja')}}</span>
                                        <span class="d-block sub-title">{{__('telah kamu pesan')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{__('Informasi tentangmu')}}
                                        <div class="float-right">
                                            <a href="{{ route('profile') }}" class="btn btn-link btn-sm">{{__('Edit')}}</a>
                                        </div>
                                    </div>
                                    <div class="form-box-content p-3">
                                        <table>
                                            <tr>
                                                <td>{{__('Alamat')}}:</td>
                                                <td class="p-2">{{ Auth::user()->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('Negara')}}:</td>
                                                <td class="p-2">
                                                    @if (Auth::user()->country != null)
                                                        {{ \App\Country::where('code', Auth::user()->country)->first()->name }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{__('Asal/Kota')}}:</td>
                                                <td class="p-2">{{ Auth::user()->city }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('Kode Pos')}}:</td>
                                                <td class="p-2">{{ Auth::user()->postal_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('No.HP')}}:</td>
                                                <td class="p-2">{{ Auth::user()->phone }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-box bg-warning mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix">Tertarik berlangganan?</div>
                                    <div class="form-box-content p-3">
                                        <h5>Tanyakan gimana cara saya berlangganan di <a href="https://asistenrumah.com">AsistenRumah.com</a></h5>
                                        <button type="button" class="btn btn-success">Chat CS</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
