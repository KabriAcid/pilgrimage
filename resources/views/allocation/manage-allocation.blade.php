@extends('layouts.master')

@section('content')
<div class="row">
<div class="col-sm-12">
    <form action="{{ route('lga_gender') }}" method="post">
        @csrf
        <div class="row">

            <div class="col-sm-3">
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

                <h6>Local Government</h6>
                <select class="form-control" id="lga">
                    <option value="">-- Select a value --</option>

                    @foreach ($lgas as $lga){
                    <option value="{{$lga->lga}}">{{$lga->lga}}</option>

                    }
                    @endforeach


                </select>
            </div>

            <div class="col-sm-3">
                <h6>Gender</h6>
                <select class="form-control" id="gender">
                    <option value="">-- Select a value --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>

                </select>
            </div>

            <!-- <div class="col-sm-2">
                <h6>Load Alhazai</h6>
                <button type="submit" class="btn btn-warning"> Load Alhazai </button>
            </div> -->

        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-3">

                    <h4>Unaccomodated</h4>
                    <select name="items[]" multiple class="form-control" id="leftBox">
                        @foreach ($unaccomodatedAlhajis as $unAccomodated => $label)
                        <option value="{{ $label->alhajiId }}">{{ $label->alhajiId. ' '.$label->fullName }}</option>
                        @endforeach
                    </select>


                </div>
                <div class="col-md-3">

                    <div class="text-center">
                        <button type="button" id="btnAllRight" class="btn btn-default">Move All &gt;&gt;</button></br>

                        <button type="button" id="btnRight" class="btn btn-default">Move &gt;</button> </br>

                        <button type="button" id="btnLeft" class="btn btn-default">&lt; Move</button></br>

                        <button type="button" id="btnAllLeft" class="btn btn-default">&lt;&lt; Move All</button>
                    </div>
                </div>
                <div class="col-md-3">

                    <h4>Allocate bed space</h4>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <select name="alhazai[]" multiple class="form-control" id="rightBox">


                    </select>
                    <h1> </h1>
                    <button type="submit" class="btn btn-warning" id="allocate"> Allocate Bed Spaces </button>

                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#btnRight').click(function() {
            var selectedOpts = $('#leftBox option:selected');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                return false;
            }
            $('#rightBox').append($(selectedOpts).clone());
            $('#rightBox option').prop('selected', true);
            $(selectedOpts).remove();
        });
        $('#btnAllRight').click(function() {
            var selectedOpts = $('#leftBox option');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                return false;
            }
            $('#rightBox').append($(selectedOpts).clone());
            $('#rightBox option').prop('selected', true);

            $(selectedOpts).remove();
        });
        $('#btnLeft').click(function() {
            var selectedOpts = $('#rightBox option:selected');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                return false;
            }
            $('#leftBox').append($(selectedOpts).clone());
            $(selectedOpts).remove();
        });
        $('#btnAllLeft').click(function() {
            var selectedOpts = $('#rightBox option');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                return false;
            }
            $('#leftBox').append($(selectedOpts).clone());
            $(selectedOpts).remove();
        });
    });






    $(document).ready(function() {
        $('#lga').on('change', function() {
            var lga = $(this).val();
            //  console.log(lga);
            $.ajax({
                url: "/alhazai/" + encodeURIComponent(lga) + "/filter",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var options = '';
                    $.each(data, function(key, value) {

                        options += '<option value="' + value.alhajiId + '">' + value.alhajiId + " " + value.fullName + '</option>';
                    });
                    $('#leftBox').html(options);
                }
            });

        });
    });

    $(document).ready(function() {
        $('#gender').on('change', function() {
            var gender = $(this).val();
            var lga = $('#lga option:selected').val();
            // alert(lga);
            if (lga.length == 0) {
                alert("Please select LGA");
                return false;
            }
            //console.log(gender);
            $.ajax({
                url: "/alhazai/" + encodeURIComponent(lga) + "/" + encodeURIComponent(gender) + "/filter",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    //alert(data);
                    var options = '';
                    $.each(data, function(key, value) {
                        options += '<option value="' + value.alhajiId + '">' + value.alhajiId + " " + value.fullName + '</option>';
                    });
                    $('#leftBox').html(options);
                }
            });

        });
    });
</script>
</div>
@endsection