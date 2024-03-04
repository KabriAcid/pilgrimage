@extends('layouts.master')

@section('content')

@php
$canViewAddPropertyForm = session('canViewAddPropertyForm');


@endphp

<div class="row">

    <div class="col-sm-9">
       

        <h1>Properties</h1>
        <table class="table table-hover">
            <thead>
                <tr>

                    <th>Property ID</th>
                    <th>Property Name</th>
                    <th>Bed Spaces</th>
                    <th>Address</th>

                </tr>
            </thead>
            <tbody>

                @foreach($properties as $property)
                <tr>
                    <td><a href="/properties/{{$property->propertyId }}/details"> {{$property->propertyId }}</a></td>
                    <td>{{ $property->name }}</td>
                    <td>{{ $property->totalBedSpaces }}</td>
                    <td>{{ $property->address }}</td>


                </tr>
                @endforeach

            </tbody>
        </table>




    </div>
    <div class="col-sm-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif




        @if ($canViewAddPropertyForm)
        <form action="{{route('store_property')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="propertyID">Property Short ID</label>
                <input type="text" class="form-control" id="propertyId" name="propertyId" value="{{old('propertyId')}}">
            </div>
            <div class="form-group">
                <label for="propertyname">Property Identifiable Name</label>
                <input type="text" class="form-control" id="propertyname" name="propertyname" value="{{old('propertyname')}}">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{old('location')}}">
            </div>
            <div class="form-group">
                <label for="distance">Distance</label>
                <input type="text" class="form-control" id="distance" name="distance" value="{{old('distance')}}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
            </div>
            <div class="form-group">
                <label for="hajjYear">Hajj Year</label>
                <input type="text" class="form-control" id="hajjYear" name="hajjYear" value="{{old('hajjYear')}}">
            </div>
            <div class="form-group">
                <label for="numberOfRooms">Total Number of Rooms</label>
                <input type="text" class="form-control" id="numberOfRooms" name="numberOfRooms" value="{{old('numberOfRooms')}}">
            </div>
            <div class="form-group">
                <label for="numberOfFloor">Number of Floors</label>
                <input type="text" class="form-control" id="numberOfFloor" name="numberOfFloor" value="{{old('numberOfFloor')}}">
            </div>
            <div class="form-group">
                <label for="hajjYear">Total Bed Spaces</label>
                <input type="text" class="form-control" id="totalBedSpaces" name="totalBedSpaces" value="{{old('totalBedSpaces')}}">
            </div>
            <div class="form-group">
                <label for="picture">Picture</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="picture" name="picture">
                    <label class="custom-file-label" for="picture">Choose file...</label>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Submit</button>
        </form>
        @endif
    </div>


</div>

@endsection