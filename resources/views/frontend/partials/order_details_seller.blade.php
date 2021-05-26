<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{__('Order id')}}: {{ $order->code }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@php
    $status = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->delivery_status;
    $payment_status = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->payment_status;
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="modal-body gry-bg px-3 pt-0">
    <div class="pt-4">
        <ul class="process-steps clearfix">
            <li @if($status == 'pending') class="active" @else class="done" @endif>
                <div class="icon">1</div>
                <div class="title">{{__('Pesanan Dilakukan')}}</div>
            </li>
            <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                <div class="icon">2</div>
                <div class="title">{{__('Dalam Peninjauan')}}</div>
            </li>
            <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done" @endif>
                <div class="icon">3</div>
                <div class="title">{{__('Pesanan Diproses')}}</div>
            </li>
            <li @if($status == 'delivered') class="done" @endif>
                <div class="icon">4</div>
                <div class="title">{{__('Selesai')}}</div>
            </li>
        </ul>
    </div>
    <div class="row mt-5">
        <div class="offset-lg-2 col-lg-4 col-sm-6">
            <div class="form-inline">
                <select class="form-control selectpicker form-control-sm"  data-minimum-results-for-search="Infinity" id="update_payment_status">
                    <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{__('Belum Dibayar')}}</option>
                    <option value="paid" @if ($payment_status == 'paid') selected @endif>{{__('Dibayar')}}</option>
                </select>
                <label class="my-2" >{{__('Pembayaran Administrasi Penyalur')}}</label>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="form-inline">
                <select class="form-control selectpicker form-control-sm"  data-minimum-results-for-search="Infinity" id="update_delivery_status">
                    <option value="pending" @if ($status == 'pending') selected @endif>{{__('Pending')}}</option>
                    <option value="on_review" @if ($status == 'on_review') selected @endif>{{__('Ditinjau')}}</option>
                    <option value="on_delivery" @if ($status == 'on_delivery') selected @endif>{{__('Diproses')}}</option>
                    <option value="delivered" @if ($status == 'delivered') selected @endif>{{__('Selesai')}}</option>
                </select>
                <label class="my-2" >{{__('Status Pesanan')}}</label>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header py-2 px-3 ">
        <div class="heading-6 strong-600">{{__('Ringkasan Pesanan')}}</div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('ID Pesanan')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Customer/Majikan')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Email')}}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Alamat Customer')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->postal_code }}, {{ json_decode($order->shipping_address)->country }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('Dipesan pada')}}:</td>
                            <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Status Pesanan')}}:</td>
                            <td>{{ $status }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Contact/No Telp')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->phone }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Pekerja')}}</div>
                    <div class="card-body pb-0">
                        <table class="details-table table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="30%">{{__('Pekerja')}}</th>
                                    <th>{{__('Job')}}</th>
                                    <!-- <th>{{__('Quantity')}}</th> -->
                                    <!-- <th>{{__('Delivery Type')}}</th>
                                    <th>{{__('Price')}}</th>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        <th>{{__('Refund')}}</th>
                                    @endif -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $key => $orderDetail)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            @if ($orderDetail->product != null)
                                                <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }} - {{$orderDetail->product->video_link}} tahun | {{$orderDetail->product->unit}} </a>
                                            @else
                                                <strong>{{ __('Product Unavailable') }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $orderDetail->product->category->name }}
                                        </td>
                                        <!-- <td>
                                            {{ $orderDetail->quantity }}
                                        </td> -->
                                        <!-- <td>
                                            @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                                {{ __('Home Delivery') }}
                                            @elseif ($orderDetail->shipping_type == 'pickup_point')
                                                @if ($orderDetail->pickup_point != null)
                                                    {{ $orderDetail->pickup_point->name }} ({{ __('Pickip Point') }})
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ single_price($orderDetail->price) }}</td>
                                        @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                            @php
                                                $no_of_max_day = \App\BusinessSetting::where('type', 'refund_request_time')->first()->value;
                                                $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                                $today_date = Carbon\Carbon::now();
                                            @endphp
                                            <td>
                                                @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered')
                                                    <a href="{{route('refund_request_send_page', $orderDetail->id)}}" class="btn btn-styled btn-sm btn-base-1">{{ __('Send') }}</a>
                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                    <span class="strong-600">{{ __('Pending') }}</span>
                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                    <span class="strong-600">{{ __('Approved') }}</span>
                                                @elseif ($orderDetail->product->refundable != 0)
                                                    <span class="strong-600">{{ __('N/A') }}</span>
                                                @else
                                                    <span class="strong-600">{{ __('Non-refundable') }}</span>
                                                @endif
                                            </td>
                                        @endif -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>

<script type="text/javascript">
    $('#update_delivery_status').on('change', function(){
        var order_id = {{ $order->id }};
        var status = $('#update_delivery_status').val();
        $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            $('#order_details').modal('hide');
            showFrontendAlert('success', 'Order status has been updated');
            location.reload().setTimeOut(500);
        });
    });

    $('#update_payment_status').on('change', function(){
        var order_id = {{ $order->id }};
        var status = $('#update_payment_status').val();
        $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            $('#order_details').modal('hide');
            //console.log(data);
            showFrontendAlert('success', 'Payment status has been updated');
            location.reload().setTimeOut(500);
        });
    });
</script>
