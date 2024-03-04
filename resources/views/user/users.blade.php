@extends('layouts.master')

@section('content')

<div class="col-sm-12">

    <div class="row">
        <!-- List of user -->
        <div class="col-sm-2">

            <form action="/users/add-user" method="post">
                @csrf
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="Email">Email </label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="Telephone">Telephone</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                </div>
                <div class="form-group">
                    <label for="Email">Password </label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                </br>
                <button type="submit" class="btn btn-warning">Add Staff</button>
            </form>
        </div>

        <div class="col-sm-8">
            <h3>User list</h3>
            <table class="table table-hover">
                <thead>
                    <th>Details </th>
                    <th> Name </th>

                    <th> Email </th>
                </thead>
                @foreach ($users as $user)
                <tr>
                    <td> <a href="/users/{{$user->id}}/details"> User Details </a> </td>
                    <td> {{$user->name }}</td>
                    <td> {{$user->email }}</td>
                    <td> @foreach ($user->userRoles as $userRole) {{$userRole->role_id}} @endforeach</td>
                </tr>
                @endforeach

            </table>
        </div>


        <div class="col-sm-2">

            <form action="{{route('assign_role')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="Name">Staff Name</label>
                    <select class="form-control" id="user_id" name="user_id">
                        <option value="">-- Select a value --</option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}"> {{$user->name}} </option>

                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="role">Staff Role</label>
                        <select class="form-control" id="role_id" name="role_id">
                            <option value="">-- Select a value --</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}"> {{$role->roleName}} </option>

                            @endforeach
                        </select>
                    </div>

                    </br>
                    <button type="submit" class="btn btn-warning">Assign</button>
            </form>
        </div>

    </div>

</div>




@endsection