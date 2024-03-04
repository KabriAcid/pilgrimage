@extends('layouts.master')

@section('content')

<div class="col-sm-10">
    <div class="row">


        <form method="POST" action="/alhazai/{{$alhaji->alhajiId}}/picture" enctype="multipart/form-data">
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
                        {{ __('Upload Alhaji Picture') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <img src="/alhazai_pictures/{{ $alhaji->picture}}" alt="Alhaji Image"  style="vertical-align: middle; width:250px">
    </div>
    <div class="row">
    <table class="table table-hover">
        <tbody>

            <tr>
                <th> ID: </th>
                <td>{{ $alhaji->alhajiId }}</td>
            </tr>
            <tr>
                <th>Name: </th>
                <td>{{ $alhaji->fullName }}</td>
            </tr>
            <tr>
                <th>Local Government: </th>
                <td>{{ $alhaji->lga }}</td>
            </tr>
            <tr>
                <th>Gender: </th>
                <td>{{ $alhaji->gender}}</td>
            </tr>
            <tr>
                <td>
                <th>Bed-space allocated: </th>
                <table class="table table-hover">
                    <thead>
                        <th> Property</th>
                        <th> Room </th>

                        <th> Bed space </th>
                    </thead>
                    @foreach ($otherSpaces as $space)

                    <tr>
                        <td><a href="/properties/{{$space->propertyId }}/details"> {{$space->propertyId }}</a> </td>
                        <!-- <td> {{$space->propertyId}} </td> -->
                        <td> {{$space->roomId}} </td>

                        <td> {{$space->spaceId}} </td>
                    </tr>

                    @endforeach

                </table>
                </td>
            </tr>



        </tbody>
    </table>
    </div>

</div>


@endsection