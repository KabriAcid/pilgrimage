@extends('layouts.master')

@section('content')


<div class="col-sm-9">
<table class="table table-hover">
    <tr><td> Total Bed Space:  </td> <td>{{$totalSpaces}} </td></tr>
    <tr><td> Total Bed Spaces Uploaded :  </td> <td>{{$uploadedBedSpace}} </td></tr>
    <tr><td> Total Number of Alhazai:  </td> <td>{{$alhazai}} </td></tr>
    <tr><td> Number of alhazai Accomodated:  </td> <td>{{$accomodated}} </td></tr>
    <tr><td> Number of alhazai Un Accomodated:  </td> <td>{{$unAccomodated}} </td></tr>

</table>

</div>


@endsection