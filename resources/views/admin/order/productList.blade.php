@extends('admin.layouts.master')
@section('title', 'Products List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('updateSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('changeSuccess'))
                        <div class="col-12 ">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-shield-check"></i> {{ session('changeSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>
                    <a href=" {{route('admin$orderList')}} " class="text-dark">
                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                    </a>
                    <div class="card mt-4 col-5">
                        <div class="card-header">
                            <h3><i class="fa-solid fa-book-open me-2"></i>Card Info </h3>
                            <small class="text-danger mt-2"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery Charges</small>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                <div class="col"> {{strtoupper($orderList[0]->user_name)}}  </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                <div class="col"> {{$orderList[0]->order_code}} </div>
                            </div> <div class="row mb-3">
                                <div class="col"><i class="fa-regular fa-clock me-2"></i>Order Date</div>
                                <div class="col">{{ $orderList[0]->created_at->format('F-j-Y')}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i>Total Price</div>
                                <div class="col">{{ $order->total_price}} Kyats</div>
                            </div>
                        </div>
                        </div>
                    </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order id</th>
                                <th>User Name</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                        <tbody id="dataList">
                            @foreach ($orderList as $o)
                                <tr class="tr-shadow t">
                                    <td></td>
                                    <td class="desc">{{ $o->id }}</td>
                                    <td class="desc">{{ $o->user_name }}</td>
                                    <td class="desc col-2"><img src=" {{asset('storage/'.$o->product_image)}} " class="img-thumbnail shadow-sm" alt=""></td>
                                    <td class="desc">{{ $o->product_name }}</td>
                                    <td class="desc">{{ $o->created_at->format('F-j-Y') }}</td>
                                    <td class="desc"> {{$o->qty}} </td>
                                    <td class="desc amount">{{ $o->total }} Kyats</td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{-- {{ $order->links() }} --}}
                    </div>
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

