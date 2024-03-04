@extends('layouts.master')

@section('content')
<div class="row">

<div class="col-sm-9">

    <h3>Property Details</h3>
    <table class="table table-hover">
        <tbody>
            <tr>
                <th>ID: </th>
                <td>{{ $property->propertyId }}</td>
            </tr>
            <tr>
                <th>Name: </th>
                <td>{{ $property->name }}</td>
            </tr>
            <tr>
                <th>Number of Rooms: </th>
                <td>{{ $property->totalRooms }}</td>
            </tr>
            <tr>
                <th>Total Bed Spaces: </th>
                <td>{{ $property->totalBedSpaces }}</td>
            </tr>

            <tr>
                <th>Uploaded Bed Spaces: </th>
                <td>{{  $uploadedSpaces}}</td>
            </tr>
            <tr>
                <th>Allocated Bed Spaces: </th>
                <td>{{ $allocated }}</td>
            </tr>
            <tr>
                <th>Available Bed Spaces: </th>
                <td>{{  $property->totalBedSpaces - $allocated }}</td>
            </tr>
            
            <tr>
                <th>Location: </th>
                <td>{{ $property->location }}</td>
            </tr>
            <tr>
                <th>Distance</th>
                <td>{{ $property->distance }}</td>
            </tr>

            <tr>
                <th>Address</th>
                <td>{{ $property->address }}</td>
            </tr>

            <tr>
                <th>Hajj Year</th>
                <td>{{ $property->hajjYear }}</td>
            </tr>
            <tr>
                <td></td>
                <td> <img src="/properties_pictures/{{ $property->propertyimg}}" alt="Property Image" width="500" height="350"></td>
            </tr>
        </tbody>
    </table>
    <form method="POST" action="/properties/{{$property->propertyId}}/picture" enctype="multipart/form-data">
        @csrf

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="row mb-3">
            <label for="picture" class="col-md-4 col-form-label text-md-end">{{ __('Picture') }}</label>

            <div class="col-md-6">
                <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" value="{{ old('picture') }}" required autocomplete="picture">


                @error('picture')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-warning">
                    {{ __('Upload Property Picture') }}
                </button>
            </div>
        </div>
    </form>


</div>

<div class="col-sm-2">
    <h3>Number of floors </h3>

    <table class="table table-hover">
        <tbody>
            @for ($i = 1; $i <= $property->numberOfFloor; $i++)
                <tr>
                    <td>

                        <a href="/properties/{{$property->propertyId }}/{{$i}}/rooms"> Floor {{$i}} </a>
                    </td>
                </tr>

                @endfor
        </tbody>
    </table>
</div>
</div>
@endsection