@extends('layouts.master')

@section('content')
@php
$canViewAddSpaceForm = session('canViewAddPropertyForm');


@endphp
<div class="row">
    <div class="col-sm-12">
        <div class="row">

            <h3> We are in {{$floor}} Floor of <a href="/properties/{{$propertyId }}/details"> {{$propertyId}} </a> </h3>

        </div>
        <div class="row">
            <!-- We list number of existing rooms here -->
            <div class="col-md-9">
                @if(isset($rooms) && $rooms->count()> 0)
                <table class="table table-hover">
                    <thead>
                        @if($canViewAddSpaceForm)
                        <th>Edit Room</th>
                        @endif
                        <th>Room Number</th>
                        <th>Bed Spaces </th>
                    </thead>

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

                    {!! $rooms->withQueryString()->links('pagination::bootstrap-5') !!}


                </table>
                @else
                <h3> No Rooms Uploaded Yet </h3>

                @endif

            </div>
            <!-- We as user to put no of rooms and spaces in each for uploda -->
            <div class="col-md-3">

                <form action="{{route('add_rooms_and_spaces')}}" method="POST">
                    @csrf
                    <!-- First Row -->

                    <div class="row">

                        <div class="form-group mb-2 mt-2">
                            <label for="numberOfRooms"> Number of Rooms </label> <input type="text" class="form-control" id="numberOfRooms" name="numberOfRooms" value="{{old('numberOfRooms')}}" placeholder="Number of Rooms" />
                        </div>



                    </div>
                    <!-- End first row -->
                    <!-- Second row -->
                    <div id="UMYUSTAFF" class="row">

                        <div class="col">
                            <div class="form-group mb-2 mt-2">
                                <label for="from"> From </label> <input type="text" class="form-control" id="from" name="from" value="{{old('numberOfRooms')}}" placeholder="From Room No" />
                            </div>
                        </div>
                        <div class="col">
                            <div id="#" class="form-group mb-2 mt-2">
                                <label for="to"> To</label> <input type="text" class="form-control" id="to" name="to" value="{{old('to')}}" placeholder="To Room No.">
                            </div>
                        </div>


                    </div>
                    <!--End Second row -->


                    <!-- Third Row -->
                    <div class="row">

                        <div class="form-group mb-2 mt-2">
                            <label for="bedSpaces"> Bed Spaces Per Room </label> <input type="text" class="form-control" id="bedSpaces" name="bedSpaces" value="{{old('bedSpaces')}}" placeholder="Number of Bed Spaces" />
                        </div>




                    </div>
                    <div class="row">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group mb-2 mt-2">
                            <input type="hidden" class="form-control" id="propertyId" name="propertyId" value="{{$propertyId}}" />
                        </div>

                        <div class="row">

                            <div class="form-group mb-2 mt-2">
                                <input type="hidden" class="form-control" id="floorNumber" name="floorNumber" value="{{$floorNumber}}" />
                            </div>



                        </div>

                    </div>
                    <div class="row">
                        <button class="btn btn-warning" type="submit" class="form-control"> Submit </button>
                    </div>

            </div>
        </div>

    </div>

</div>
@endsection