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

    <div class="row">
        <div class="col-md-9">


            <table class="table table-hover">

                <thead>

                    <th> ID </th>
                    <th> Name </th>
                    <th> Local Government </th>
                    <th> Town </th>
                    <th> Gender</th>
                    <th> Hajj Year</th>
                    <!-- <th> AirLifted </th>
                    <th> Accomodated </th> -->
                </thead>
                @foreach ($alhazai as $alhaji)
                <tr>

                    <td> <a href="/alhazai/{{$alhaji->alhajiId }}/alhaji-bed-space">{{$alhaji->alhajiId}} </a> </td>
                    <td> {{$alhaji->fullName}} </td>
                    <td> {{$alhaji->lga}} </td>
                    <td> {{$alhaji->town}} </td>
                    <td> {{$alhaji->gender}} </td>
                    <td> {{$alhaji->hajjYear}} </td>
                    <!-- <td> {{$alhaji->airLifted}} </td>
                    <td> {{$alhaji->accomodated}} </td> -->
                </tr>

                @endforeach
            </table>


            {!! $alhazai->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
        <div class="col-md-3">

            <form action="{{route('store_special')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="Alhaji Id">Staff Name</label>
                    <select class="form-control" id="alhajiId" name="alhajiId">
                        <option value="">-- Select a value --</option>
                        @foreach($alhazai as $alhaji)
                        <option value="{{$alhaji->alhajiId}}"> {{$alhaji->alhajiId}} {{$alhaji->fullName}} </option>

                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="bedSpace">Bed Space</label>
                        <select class="form-control" id="bedSpace" name="bedSpace">
                            <option value="">-- Select a value --</option>
                            @foreach($bedSpaces as $bedSpace)
                            <option value="{{$bedSpace->spaceId}}/{{$bedSpace->roomId}}/{{$bedSpace->propertyId}}">{{$bedSpace->spaceId}} in {{$bedSpace->roomId}} of {{$bedSpace->propertyId}}</option>

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