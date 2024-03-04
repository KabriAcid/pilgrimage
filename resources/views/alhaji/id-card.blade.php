@extends('layouts.master')

@section('content')
<style>
    body {
      font-family: Arial, sans-serif;
    }
    </style>
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
    @foreach ($alhazai as $alhaji)
           
<div class="id-card">
  <strong>Katsina State Pilgrims’ Welfare Board</strong>
 
  <img src="/alhazai_pictures/{{ $alhaji->picture }}" alt="Alhaji Image" />
  
  <table class="table table-sm">
    <tr>
      <th>Name:</th>
      <td>{{$alhaji->fullName}}</td>
    </tr>
    <tr>
      <th>Country:</th>
      <td>Nigeria</td>
    </tr>
    <tr>
      <th>State:</th>
      <td>Katsina</td>
    </tr>
    <tr>
      <th>LGA</th>
      <td>{{$alhaji->lga}}</td>
      
    </tr>
   <tr>
   <td colspan="2" style="text-align: center;">
  {{ QrCode::size(90)->generate("Alhaji Id: $alhaji->alhajiId\nName: $alhaji->fullName\nCountry: Nigeria\nPassport Number: $alhaji->passportNo\nHealth Status: $alhaji->healthStatus\nState: Katsina\nLGA: $alhaji->lga\nTown: $alhaji->town") }} 
</td>

</td>

   </tr>
  </table>
  {!! $alhazai->withQueryString()->links('pagination::bootstrap-5') !!}
</div>
@endforeach
@endsection