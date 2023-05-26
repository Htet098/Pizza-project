@extends('admin.layouts.master')
@section('title', 'Admin List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    {{-- <div class="row my-2 ">
                        <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center">
                            <h3 class="text-secondary"><i class="fa-solid fa-folder-open"></i> -{{$admin->total()}}
                            </h3>
                        </div>
                    </div> --}}
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
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($user->image == null)
                                                @if ($user->gender == 'male')
                                                    <img src="{{ asset('images/default_user.png') }}"
                                                        class="img-thumbnail shadow-sm" />
                                                @elseif ($user->gender == 'female')
                                                    <img src="{{ asset('images\female-default.jpg') }}"
                                                        class="img-thumbnail shadow-sm" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$user->image) }} " class="img-thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" id="userId" value=" {{ $user->id }} ">
                                        <td> {{ $user->name }} </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <select class="form-control statusChange">
                                                <option value="admin" @if ($user->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($user->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </td>

                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $users->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {

            //status change
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                console.log($currentStatus);
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();
                console.log($userId);
                $data = {
                    'userId': $userId,
                    'role': $currentStatus
                }
                // console.log($data);

                $.ajax({
                    type: 'get',
                    url: '/user/change/role',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
                // window.location.href = "http://127.0.0.1:8000/order/list";

            })

        })
    </script>

@endsection
