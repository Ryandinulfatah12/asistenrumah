<div class="card sticky-top">
    <div class="card-title py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <h3 class="heading heading-3 strong-400 mb-0">
                    <span>{{__('Pesan Pekerja')}}</span>
                </h3>
            </div>

            <div class="col-6 text-right">
                <span class="badge badge-md badge-success">{{ count(Session::get('cart')) }} {{__('Pekerja')}}</span>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @php
                $total_point = 0;
            @endphp
            @foreach (Session::get('cart') as $key => $cartItem)
                @php
                    $product = \App\Product::find($cartItem['id']);
                    $total_point += $product->earn_point*$cartItem['quantity'];
                @endphp
            @endforeach
            <div class="club-point mb-3 bg-soft-base-1 border-light-base-1 border">
                {{ __("Total Club point") }}:
                <span class="strong-700 float-right">{{ $total_point }}</span>
            </div>
        @endif
        <table class="table-cart table-cart-review">
            <thead>
                <tr>
                    <th class="product-name">{{__('Nama Pekerja')}}</th>
                    <th class="product-total text-right">{{__('Job')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;
                @endphp
                @foreach (Session::get('cart') as $key => $cartItem)
                    @php
                    $product = \App\Product::find($cartItem['id']);
                    $subtotal += $cartItem['price']*$cartItem['quantity'];
                    $tax += $cartItem['tax']*$cartItem['quantity'];
                    $shipping += $cartItem['shipping']*$cartItem['quantity'];
                    $product_name_with_choice = $product->name;
                    if ($cartItem['variant'] != null) {
                        $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                    }
                    // if(isset($cartItem['color'])){
                    //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                    // }
                    // foreach (json_decode($product->choice_options) as $choice){
                    //     $str = $choice->name; // example $str =  choice_0
                    //     $product_name_with_choice .= ' - '.$cartItem[$str];
                    // }
                    @endphp
                    <a href="#" onclick="removeFromCartView(event, {{ $key }})" class="btn btn-danger mb-3">
                            <i class="la la-ban"></i> Batal
                    </a>
                    <tr class="cart_item">
                        
                        <div class="text-center mb-4">
                            <img loading="lazy" class="mx-auto" src="{{ asset($product->thumbnail_img) }}" width="50%">
                        </div>
                        <td class="product-name">
                            {{ $product_name_with_choice }}
                            <!-- <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong> -->
                        </td>
                        <td class="product-total text-right">
                            <!-- <span class="pl-4">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span> -->
                            <span class="pl-4">{{ $product->category->name }}</span>
                        </td>
                        
                    </tr>

                    <div class="row my-5">
                        <div class="col-sm-6">
                            <div class="card">
                            <div class="card-body bg-white">
                                <h5 class="card-title">Administrasi Penyalur</h5>
                                <p class="card-text">Anda perlu membayar biaya admin untuk pengambilan pekerja dari penyalur ini.</p>
                                <button type="button" class="btn btn-success btn-lg">{{ $product->pdf }}</button>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                            <div class="card-body bg-success text-white">
                                <h5 class="card-title">Administrasi Website</h5>
                                <p class="card-text">Admin ini berupa layanan/jasa pengambilah pekerja melalui website AsistenRumah.com.</p>
                                <button type="button" class="btn btn-warning btn-lg">Rp. 100.000</button>
                            </div>
                            </div>
                        </div>
                    </div>


                @endforeach
            </tbody>
        </table>

        <!-- <table class="table-cart table-cart-review my-4">
            <thead>
                <tr>
                    <th class="product-name">{{__('Biaya Administrasi Web Asisten Rumah')}}</th>
                    <th class="product-total text-right">{{__('Amount')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Session::get('cart') as $key => $cartItem)
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ \App\Product::find($cartItem['id'])->name }}
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">IDR {{ ($cartItem['shipping']*$cartItem['quantity']) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> -->

        <table class="table-cart table-cart-review">

            <tfoot>
                <!-- <tr class="cart-subtotal">
                    <th>{{__('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="strong-600">{{ single_price($subtotal) }}</span>
                    </td>
                </tr>

                <tr class="cart-shipping">
                    <th>{{__('Tax')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ single_price($tax) }}</span>
                    </td>
                </tr> -->

                <!-- <tr class="cart-shipping">
                    <th>{{__('Total Biaya Administrasi')}}</th>
                    <td class="text-right">
                        <span class="text-italic">IDR {{ ($shipping) }}</span>
                    </td>
                </tr> -->

                @if (Session::has('coupon_discount'))
                    <tr class="cart-shipping">
                        <th>{{__('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price(Session::get('coupon_discount')) }}</span>
                        </td>
                    </tr>
                @endif

                @php
                    $total = $subtotal+$tax+$shipping;
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                @endphp

                <!-- <tr class="cart-total">
                    <th><span class="strong-600">{{__('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span>IDR {{ ($total) }}</span></strong>
                    </td>
                </tr> -->
            </tfoot>
        </table>

        @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
            @if (Session::has('coupon_discount'))
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <div class="form-control bg-gray w-100">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Change Coupon')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <input type="text" class="form-control w-100" name="code" placeholder="{{__('Have coupon code? Enter here')}}" required>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                    </form>
                </div>
            @endif
        @endif

    </div>
</div>
