@extends('layouts.master')

@section('content')
<div class="row">
<div class="col-sm-12">
    <form action="{{ route('store_official_allocation') }}" method="post">
        @csrf
        <div class="row">
            <!-- offcial, property, room, spaces -->

            <div class="col-sm-2">
                <h6>Official</h6>
                <select class="form-control" id="alhajiId" name="alhajiId">
                    <option value="">-- Select a value --</option>
                    @foreach ($officials as $official)
                    <option value="{{$official->alhajiId}}">{{$official->fullName}}</option>


                    @endforeach


                </select>
            </div>
            <div class="col-sm-2">
                <h6>Property</h6>
                <select class="form-control" id="propertyId" name="propertyId">
                    <option value="">-- Select a value --</option>
                    @foreach ($properties as $property){
                    <option value="{{$property->propertyId}}">{{$property->propertyId}}</option>

                    }
                    @endforeach


                </select>
            </div>
            <div class="col-sm-3">

                <h6>Room</h6>
                <select class="form-control" id="roomId" name="roomId">
                    <option value="">-- Select a value --</option>
                    @foreach($rooms as $room)

                    <option value="{{$room->roomId}}"> {{$room->roomId}} in {{$room->propertyId}} </option>

                    @endforeach


                </select>
            </div>

            <div class="col-sm-3">
                <h6>Spaces</h6>
                <select class="form-control" id="spaces" name="spaces">
                    <option value="">-- Select a value --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>

                </select>
            </div>

            <div class="col-sm-2">
                <h6>Load Alhazai</h6>
                <button type="submit" class="btn btn-warning"> allocate</button>
            </div>

        </div>



    </form>
</div>
</div>

@endsection