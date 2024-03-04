@extends('layouts.master')

@section('content')
<div class="col-sm-9">
    <div class="row">
        <div class="col-sm-3">
            <form action="/report/fetch-spaces" method="post">
                @csrf
                <h6>Property</h6>
                <select class="form-control" id="propertyId" name="propertyId">
                    <option value="">-- Select a value --</option>
                    <option value="all">All</option>
                    @foreach ($properties as $property){
                    <option value="{{$property->propertyId}}">{{$property->propertyId}}</option>

                    }
                    @endforeach


                </select>
                <button type="submit" class="btn btn-warning">Fetch</button>
            </form>
        </div>

    </div>


</div>



@endsection