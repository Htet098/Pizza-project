@extends('admin.layouts.master')
@section('title', 'Detail Account')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        @if (session('updateSuccess'))
                            <div class="col-12 ">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-shield-check"></i> {{ session('updateSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm" />
                                </div>
                                <div class="col-7 ">
                                    <div class="my-3 btn bg-danger text-white fs-5 d-block w-50 text-center"> <i class="fa-solid fa-file-signature me-2"></i> {{ $pizza->name }}</div>
                                    <span class="my-3 btn bg-dark text-white "><i class="fa-solid fa-money-bill-wave me-2"></i> {{ $pizza->price }}</span>
                                    <span class="my-3 btn bg-dark text-white "><i class="fa-solid fa-clock me-2"></i> {{ $pizza->waiting_time }}</span>
                                    <span class="my-3 btn bg-dark text-white "><i class="fa-solid fa-eye me-2"></i> {{ $pizza->view_count }}</span>
                                    <span class="my-3 btn bg-dark text-white "><i class="fa-regular fa-newspaper me-2"></i> {{ $pizza->category_name}}</span>
                                    <span class="my-3 btn bg-dark text-white "><i class="fa-solid fa-address-card me-2"></i> {{ $pizza->created_at->format('j-F-Y') }}</span>
                                    <div class="my-3"><i class="fa-solid fa-file-pen me-2"></i> Details</div>
                                    <div class="">{{ $pizza->description }}</div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-4 offset-2 mt-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- END MAIN CONTENT-->
    @endsection
