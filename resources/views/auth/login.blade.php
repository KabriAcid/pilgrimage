@extends('layouts.master')

@section('content')
<div class="col-md-12"> <!--change col-sm-8 to col-md-8-->

    <div class="row">
        <div class="col-md-4"> <!--change col-sm-4 to col-md-4-->

        </div>
        <div class="col-md-3">
            <div class="loginKey">
                <!-- <img class="mb-4" src="{!! url('images/keys.jpg') !!}" alt="" width="250" height="150" > -->
            </div>
        </div>
        <div class="col-md-2"> <!--change col-sm-2 to col-md-2-->

        </div>
    </div>
    <form method="post" action="/login" class="mt-3"> <!--add class mt-3 to add some margin-->

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />


        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="email" placeholder="email" autofocus>
            <label for="floatingName">Email or Username</label>

            <span class="text-danger text-left">{{ $errors->first('email') }}</span>

        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>

            <span class="text-danger text-left">{{ $errors->first('password') }}</span>

        </div>

        <button class="w-100 btn btn-lg  btn-secondary" type="submit">Login</button>


    </form>
</div>

@stop