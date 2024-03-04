@extends('layouts.master')

@section('content')

<div class="col-sm-9">
    <table class="table table-hover">
        <tr>
            <td>Name : </td>
            <td>{{$user->name}} </td>
        </tr>
        <tr>
            <td>Email : </td>
            <td>{{$user->email}} </td>
        </tr>
        <tr >
            <td>Assigned Role</td>
            <td>
                @foreach($actualRoles as $actualRole)
                {{$actualRole}} </br>
          

            @endforeach
            </td>
        </tr>

    </table>

</div>



@endsection