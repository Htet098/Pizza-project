@extends('admin.layouts.master')
@section('content')
<div class="row mt-5">
      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Contact Details</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-10  offset-1">
                                    <div class="my-3"> <i class="fa-solid fa-user  me-3"></i> {{ $contact->name }}</div>
                                    <div class="my-3 "><i class="fa-solid fa-envelope me-3"></i> {{ $contact->email }}</div>
                                    <p class="my-3 "><i class="fa-solid fa-comments me-3"></i> {{ $contact->message }}</p>
                                </div>
                            </div>
                            {{-- <div class="row ">
                                <div class="col-4 offset-8 mt-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit
                                        </button>
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- END MAIN CONTENT-->
</div>

@endsection
