@extends('layouts.master')

@section('content')
@php
$canViewAddSpaceForm = session('canViewAddPropertyForm');


@endphp

<div class="col-sm-12">
    <div class="row">
        <h3>There are {{count($rooms)}} Rooms in {{$floor}} Floor of <a href="/properties/{{$rooms[0]->propertyId}}/details"> {{$rooms[0]->propertyId}} </a></h3>
        <table class="table table-hover">

            <tr>
                <!-- <th>Property ID</th> -->

                @if($canViewAddSpaceForm)
                <th>Edit Room</th>
                @endif
                <th>Room Number</th>
                <th>Bed Spaces </th>
            </tr>

            <tbody>
                @foreach ($rooms as $room)
                <tr>

                    @if($canViewAddSpaceForm)
                    <td><a href="/properties/{{$room->propertyId}}/{{$room->roomId}}/room-bed-spaces">Edit</ </td>
                            @endif
                    <td>{{$room->roomId}} ( {{count ($room->bedSpaces())}} Bed spaces )</td>

                    @foreach ($room->bedSpaces() as $bedSpace)
                    @if(is_null($bedSpace->alhajiId))

                    <td><a style="background-color: #0bad0b; color:aliceblue" href="/properties/{{$room->propertyId }}/{{$room->roomId}}/{{$bedSpace->spaceId}}/details">{{$bedSpace->spaceId}} | </a></td>
                    @else

                    <td><a style="background-color: #da3b0b; color:aliceblue" href="/properties/{{$room->propertyId }}/{{$room->roomId}}/{{$bedSpace->spaceId}}/details">{{$bedSpace->spaceId}} | </a></td>
                    @endif

                    @endforeach

                </tr>
                @endforeach
            </tbody>
        </table>

        {!! $rooms->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>

</div>


@endsection