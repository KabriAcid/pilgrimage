@extends('layouts.master')

@section('content')

<div class="col-sm-9">
<h1 class="warning"> An intrusion attempt. You must not access unauthorized pages! </h1>
<h13 class="warning"> <a href="{{route('login.show')}}">Click here to log bag </a></h3>

</div>
@endsection 