@extends('layouts.master')

@section('content')
<div class="col-sm-12">

    <div class="row">
        <div class="container">
            <form action="#" method="POST" role="search" class="searchForm">
                {{ csrf_field() }}
                @method('GET')
                <div class="input-group">
                    <input type="text" class="form-control" name="searchString" placeholder="Search Alhaji">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search">Search Alhaji</span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>


    <table class="table table-hover">

        <thead>

            <th> ID </th>
            <th> Name </th>
            <th> Passport Number </th>
            <th> Local Government </th>
            <th> Town </th>
            <th> Gender</th>
            <th> Hajj Year</th>
            <th> AirLifted </th>
            <th> Accomodated </th>
        </thead>
        @foreach ($alhazai as $alhaji)
        <tr>

            <td> <a href="/alhazai/{{$alhaji->alhajiId }}/alhaji-bed-space">{{$alhaji->alhajiId}} </a> </td>
            <td> {{$alhaji->fullName}} </td>
            <td> {{$alhaji->passportNo}} </td>
            <td> {{$alhaji->lga}} </td>
            <td> {{$alhaji->town}} </td>
            <td> {{$alhaji->gender}} </td>
            <td> {{$alhaji->hajjYear}} </td>
            <td> {{$alhaji->airLifted}} </td>
            <td> {{$alhaji->accomodated}} </td>
        </tr>

        @endforeach
    </table>


    {!! $alhazai->withQueryString()->links('pagination::bootstrap-5') !!}

</div>





@endsection