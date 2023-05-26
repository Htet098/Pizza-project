@extends('admin.layouts.master')
@section('title', 'Edit Category')
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
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Account</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('images/default_user.png') }}"
                                                    class="img-thumbnail shadow-sm" />
                                            @elseif (Auth::user()->gender == 'female')
                                                <img src="{{ asset('images\female-default.jpg') }}"
                                                    class="img-thumbnail shadow-sm" />
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail shadow-sm" />
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image" id=""
                                                class="form-control @error('image') is-invalid  @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>
                                                Update
                                            </button>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="textpassword"
                                                value="{{ Auth::user()->name }}"
                                                class="form-control @error('name') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter your name ">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="textpassword"
                                                value="{{ Auth::user()->email }}"
                                                class="form-control @error('email') is-invalid  @enderror"aria-required="true"
                                                aria-invalid="false" placeholder="Enter your email ">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number"
                                                value="{{ Auth::user()->phone }}"
                                                class="form-control @error('phone') is-invalid  @enderror"aria-required="true"
                                                aria-invalid="false" placeholder="Enter your phone ">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid  @enderror">
                                                <option value="">Choose gender......</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>

                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid  @enderror" cols="30" rows="10">{{ Auth::user()->address }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text"
                                                value="{{ Auth::user()->role }}"
                                                class="form-control @error('confirmPassword') is-invalid  @enderror"aria-required="true"
                                                aria-invalid="false" placeholder="Enter your role " disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- END MAIN CONTENT-->
    @endsection
