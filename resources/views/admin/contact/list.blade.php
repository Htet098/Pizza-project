@extends('admin.layouts.master')
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
                                <h2 class="title-1">Contact List</h2>

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
                    {{-- @if (session('updateSuccess'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif --}}
                    {{-- @if (session('changeSuccess'))
                    <div class="col-12 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-shield-check"></i> {{ session('changeSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif --}}

                </div>
                {{-- @if (count($pizzas) != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($contact as $c)
                                <tr class="tr-shadow t">
                                    {{-- <input type="hidden" class="orderId" value="{{ $c->id }}"> --}}
                                    <td class="desc">{{ $c->id }}</td>
                                    <td class="desc">{{ $c->name }}</td>
                                    <td class="desc">{{ $c->email }}</td>
                                    <td class="desc amount">{{ Str::words($c['message'], 5, '.....') }} </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href=" {{ route('admin#contactMoreInfoList', $c->id) }} ">
                                                <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                    title="More">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>

                                            <a href=" {{ route('admin#contactDeleteList', $c->id) }} ">
                                                <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{ $contact->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
@endsection
