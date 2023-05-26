@extends('admin.layouts.master')
@section('title', 'Edit Category')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('admin#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#change', $account->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'male')
                                                <img src="{{ asset('images/default_user.png') }}"
                                                    class="img-thumbnail shadow-sm" />
                                            @elseif ($account->gender == 'female')
                                                <img src="{{ asset('images\female-default.jpg') }}"
                                                    class="img-thumbnail shadow-sm" />
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" class="img-thumbnail shadow-sm" />
                                        @endif
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>
                                                Change
                                            </button>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled name="name" type="textpassword"
                                                value="{{ $account->name }}"
                                                class="form-control @error('name') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter your name ">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" id="" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled name="email" type="textpassword"
                                                value="{{ $account->email }}"
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
                                            <input id="cc-pament" disabled name="phone" type="number"
                                                value="{{ $account->phone }}"
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
                                            <select name="gender" disabled
                                                class="form-control @error('gender') is-invalid  @enderror">
                                                <option value="">Choose gender......</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
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
                                            <textarea name="address" disabled class="form-control @error('address') is-invalid  @enderror" cols="30" rows="10">{{ Auth::user()->address }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    @endsection
