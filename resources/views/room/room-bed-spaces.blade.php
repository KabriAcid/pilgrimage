@extends('layouts.master')

@section('content')
@php
$canViewAddSpaceForm = session('canViewAddPropertyForm');


@endphp

<div class="col-sm-9">
    <div class="row">
        <h1>There are {{$bedSpaces ? $bedSpaces->count() : 0}}
 Bedspaces in {{$room->roomId}} of <a href="/properties/{{$room->propertyId }}/details"> {{$room->propertyId }}</a> </h1>

    </div>
    <!-- Row with the list of bed_spaces and form to add -->

    <div class="row">
        <div class="col-sm-7">
        @if (session('danger'))
            <div class="alert alert-danger" role="alert">
                {{ session('danger') }}
            </div>
            @endif
            @if(isset($bedSpaces) && $bedSpaces->count()> 0)
            <table class="table table-hover">

                <thead>
                    <th> Bed Space Number </th>
                    <th> Allocated </th>
                    <th> Ahajji Occupying it </th>
                </thead>
                @foreach($bedSpaces as $bedSpace)

                <tr>
                    @if(is_null($bedSpace->alhajiId))

                    <td><a style="background-color: #0bad0b; color:aliceblue" href="/properties/{{$room->propertyId }}/{{$room->roomId}}/{{$bedSpace->spaceId}}/details">{{$bedSpace->spaceId}} | </a></td>
                    @else

                    <td><a style="background-color: #da3b0b; color:aliceblue" href="/properties/{{$room->propertyId }}/{{$room->roomId}}/{{$bedSpace->spaceId}}/details">{{$bedSpace->spaceId}} | </a></td>
                    @endif


                    <td>{{$bedSpace->isAllocated}}</td>
                    <td>{{ $bedSpace->alhajiId}} </td>
                </tr>


                @endforeach
            </table>

            @else
            <p>No bed-space Uploaded yet. </p>
            @endif

        </div>
        <div class="col-sm-2">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
@if($canViewAddSpaceForm)
            @if(!isset($bedSpaces) || $bedSpaces->count() == 0)
            <form action="/properties/room/add-bed-spaces" method="post">
                @csrf
                <div class="form-group">
                    <label for="propertyID">Property short ID</label>
                    <input type="text" class="form-control" id="propertyId" name="propertyId" value="{{$room->propertyId}}" readonly>
                </div>
                <div class="form-group">
                    <label for="roomName">Room Id</label>
                    <input type="text" class="form-control" id="roomId" name="roomId" value="{{$room->roomId}}" readOnly>
                </div>
                <div class="form-group">
                    <label for="location">Number of Bed Spaces </label>
                    <input type="text" class="form-control" id="numberOfSpaces" name="numberOfSpaces" value="{{old('numberOfSpaces')}}">
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
            @endif
            @endif
        </div>
    </div>

</div>


@endsection