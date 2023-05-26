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
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                    <div class="row">
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
                    </div>
                    <div class="row my-2 ">
                        <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center">
                            <h3 class="text-secondary"><i class="fa-solid fa-folder-open"></i> {{ $pizzas->total() }}
                            </h3>
                        </div>
                    </div>
                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow">
                                            <th class="col-2"> <img src="{{ asset('storage/' . $p->image) }}"
                                                    class="img-thumbnail shadow-sm" alt=""></th>
                                            <td class="desc">{{ $p->name }}</td>
                                            <td>{{ $p->price }}</td>
                                            <td>{{ $p->category_name }}</td>
                                            <td><i class="fa-solid fa-eye me-2"></i>{{$p->view_count}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#updatePage',$p->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                         title="Edit">
                                                         <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    </a>
                                                    <a href="{{ route('product#edit',$p->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#delete', $p->id) }}">
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
                                {{ $pizzas->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center ">There is no pizza here!</h3>

                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
