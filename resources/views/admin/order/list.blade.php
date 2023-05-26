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
                            {{-- <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button> --}}
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
                    {{-- <div class="row">
                        <div class="col-3">
                            <h3 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h3>
                        </div>
                        <div class="col-4 offset-5">
                            <form class="form-header" action="{{ route('product#list') }}" method="get">
                                <input class="form-control " type="search" name="key"
                                    placeholder="Search for datas &amp; reports..." value="{{ request('key') }}" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div> --}}
                    <div class="row my-2 ">
                        <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center">
                            <h3 class="text-secondary"><i class="fa-solid fa-folder-open me-2">
                                </i>{{ count($order) }}
                            </h3>
                        </div>
                    </div>
                    <form action=" {{ route('admin#changeStatus') }} " method="get" class="col-5">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-folder-open me-2">
                                    </i>{{ count($order) }}
                                </span>
                            </div>
                            <select id="orderStatus" name="orderStatus" class="form-select" id="inputGroupSelect">
                                <option value="all">All</option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" for="inputGroupSelect"
                                    class="btn btn-sm ms-2 bg-dark text-white input-group-text"><i
                                        class="fa-solid fa-magnifying-glass me-2"></i>Search</button>

                            </div>
                    </form>

                </div>
                {{-- @if (count($pizzas) != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User id</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                                <tr class="tr-shadow t">
                                    <input type="hidden" class="orderId" value="{{ $o->id }}">
                                    <td class="desc">{{ $o->user_id }}</td>
                                    <td class="desc">{{ $o->user_name }}</td>
                                    <td class="desc">{{ $o->created_at->format('F-j-Y') }}</td>
                                    <td class="desc">
                                        {{-- {{ $o->order_code }} --}}
                                        <a href=" {{route('admin#listInfo',$o->order_code)}} " class="text-success">{{ $o->order_code }}</a>
                                    </td>
                                    <td class="desc amount">{{ $o->total_price }} Kyats</td>
                                    <td class="desc">
                                        <select name="status" id="" class="form-control statusChange">
                                            <option value="0" @if ($o->status == 0) selected @endif>
                                                Pending</option>
                                            <option value="1" @if ($o->status == 1) selected @endif>
                                                Accept</option>
                                            <option value="2" @if ($o->status == 2) selected @endif>
                                                Reject</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{-- {{ $order->links() }} --}}
                    </div>
                </div>
                {{-- @else --}}
                {{-- <h3 class="text-secondary text-center ">There is no pizza here!</h3> --}}

                {{-- @endif --}}

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     // console.log('hello');
            //     $status = $('#orderStatus').val();
            //     console.log($status);
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://127.0.0.1:8000/order/ajax/status',
            //         data: {
            //             'status': $status
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             // console.log(response);
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {

            //                 $months = ['Junary', 'February', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];
            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
            //                     "-" + $dbDate.getFullYear();
            //                 // console.log($finalDate);
            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `<select name = "status" class = "form-control statusChange" >
        //                         <option value = "0" selected> Pending </option>
        //                         <option value = "1" > Accept </option>
        //                         <option value = "2" > Reject </option>
        //                         </select>`;
            //                 }
            //                 else if(response[$i].status == 1){
            //                     $statusMessage = `<select name = "status" class = "form-control statusChange" >
        //                         <option value = "0" > Pending </option>
        //                         <option value = "1" selected> Accept </option>
        //                         <option value = "2" > Reject </option>
        //                         </select>`;
            //                 }else if(response[$i].status == 2){
            //                     $statusMessage = `<select name = "status" class = "form-control statusChange" >
        //                         <option value = "0" > Pending </option>
        //                         <option value = "1" > Accept </option>
        //                         <option value = "2" selected> Reject </option>
        //                         </select>`;}

            //                 $list += `<tr class="tr-shadow">
        //                                 <input type="hidden" class="orderId" value="${response[$i].id}">
        //                                 <td class="desc">${response[$i].user_id}</td>
        //                                 <td class="desc">${response[$i].user_name}</td>
        //                                 <td class="desc">${$finalDate}</td>
        //                                 <td class="desc">${response[$i].order_code}</td>
        //                                 <td class="desc">${response[$i].total_price} Kyats</td>
        //                                 <td class="desc">${$statusMessage}</td>
        //                             </tr>`;
            //             }
            //             $('#dataList').html($list);
            //         }
            //     })
            // })
            //status change
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();
                // console.log($orderId);
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                }
                console.log($data);

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
                // window.location.href = "http://127.0.0.1:8000/order/list";

            })

        })
    </script>

@endsection
