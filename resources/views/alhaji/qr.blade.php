@extends('layouts.master')

@section('content')
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
<div class="col-sm-9">
    <div class="row">
        </br>
        </br>
        </br>
    </div>


    <div class="row">
        <div class="col-sm-3">

        </div>


        <div class="col-sm-3">
            @foreach ($qrCodes as $qrCode)
            {{ $qrCode }}
            </br>
            .............
            </br>
            @endforeach
        </div>
        <div class="col-sm-3">

        </div>
    </div>
</div>


@endsection