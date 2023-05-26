@extends('user.layouts.master')
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <a href=" {{ route('user#home') }} " class="text-dark  text-decoration-none">
                    <i class="fa-solid fa-arrow-left-long me-1"></i> back
                </a>
                <div id="product-carousel" class="carousel slide mt-2" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30 mt-2">
                <div class="h-100 bg-light p-30">
                    <h3> {{ $pizza->name }} </h3>
                    <input type="hidden" value=" {{ Auth::user()->id }} " id="userId">
                    <input type="hidden" value=" {{ $pizza->id }} " id="pizzaId">
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            {{-- <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small> --}}
                        </div>
                        <small class="pt-1"><i class="fa-solid fa-eye me-1"></i>{{ $pizza->view_count + 1 }}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4"> {{ $pizza->price }}Kyats </h3>
                    <p class="mb-4"> {{ $pizza->description }} </p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="number" class="form-control  border-0 text-center " value="1"
                                id="orderCount">

                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="addCartBtn" type="button"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">ph
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }} " alt=""
                                    style="height: 250px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }}Kyats</h5>
                                    {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>({{ $p->view_count }})</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            // console.log($('#pizzaId').val());

            //increase view count
            $.ajax({
                    type : 'get',
                    url : '/user/ajax/increase/viewCount',
                    data : {'productId': $('#pizzaId').val()},
                    dataType : 'json',

                })

            //add to cart btn
            $('#addCartBtn').click(function() {
                $source = {
                    'count': $('#orderCount').val(),
                    'userId': $('#userId').val(),
                    'pizzaId': $('#pizzaId').val()
                };
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/addToCart',
                    data : $source,
                    dataType : 'json',
                    success : function(response){
                        // console.log(response);
                        if(response.status == 'success'){
                            window.location.href= "/user/homepage"
                        }
                    }

                })
            })
        })
    </script>
@endsection
