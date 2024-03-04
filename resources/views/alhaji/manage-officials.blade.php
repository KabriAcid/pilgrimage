@extends('layouts.master')

@section('content')

<div class="col-sm-9">
<form action="{{route('store_uploaded_officials')}}"
					method="POST"
					enctype="multipart/form-data">
					@csrf
                    <input type="file" name="file"
                           class="form-control">
                    <br>
                    <button class="btn btn-success">
                          Upload officials
                       </button>
                    <a class="btn btn-secondary" 
                       href="{{route('officials_excel_template')}}"">
                              Download Excel template for officials
                      </a>
                </form>


</div>

@endsection