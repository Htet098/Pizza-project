@extends('admin.layouts.master')
@section('title', 'Admin List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        {{-- <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div> --}}
                    </div>
                    @if (session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
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
                    <div class="row">
                        <div class="col-3">
                            <h3 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h3>
                        </div>
                        <div class="col-4 offset-5">
                            <form class="form-header" action="{{ route('admin#list') }}" method="get">
                                <input class="form-control " type="search" name="key"
                                    placeholder="Search for datas &amp; reports..." value="{{ request('key') }}" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2 ">
                        <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center">
                            <h3 class="text-secondary"><i class="fa-solid fa-folder-open"></i> -{{$admin->total()}}
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <th class="col-2">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                    <img src="{{ asset('images/default_user.png') }}"
                                                        class="img-thumbnail shadow-sm" />
                                                @elseif ($a->gender == 'female')
                                                    <img src="{{ asset('images\female-default.jpg') }}"
                                                        class="img-thumbnail shadow-sm" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}" class="img-thumbnail shadow-sm"/>
                                            @endif

                                        </th>
                                        <td class="desc">{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">

                                                    @if (Auth::user()->id== $a->id)
                                                    @else
                                                    <a href="{{route('admin#changeRole',$a->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Change Role">
                                                            <i class="fa-solid fa-user-xmark"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('admin#delete',$a->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    @endif

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $admin->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
