@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
       

            <div class="card">
                <div class="card-header">Add Alhaji</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('alhajis.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="alhajiId">Identification Number</label>
                            <input type="text" class="form-control" id="alhajiId" name="alhajiId" required>
                        </div>
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>

                        <div class="form-group">
                            <label for="passportNo">Passport Number</label>
                            <input type="text" class="form-control" id="passportNo" name="passportNo" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hajjYear">Hajj Year</label>
                            <select class="form-control" id="hajjYear" name="hajjYear" required>
                                <option value="">Select</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lga">LGA</label>
                            <select class="form-control" id="lga" name="lga" required>
                                <option value="">Select</option>
                                <option value="Bakori">Bakori</option>
                                <option value="Batagarawa">Batagarawa</option>
                                <option value="Batsari">Batsari</option>
                                <option value="Baure">Baure</option>
                                <option value="Bindawa">Bindawa</option>
                                <option value="Charanchi">Charanchi</option>
                                <option value="Dandume">Dandume</option>
                                <option value="Danja">Danja</option>
                                <option value="Dan Musa">Dan Musa</option>
                                <option value="Daura">Daura</option>
                                <option value="Dutsi">Dutsi</option>
                                <option value="Dutsinma">Dutsinma</option>
                                <option value="Faskari">Faskari</option>
                                <option value="Funtua">Funtua</option>
                                <option value="Ingawa">Ingawa</option>
                                <option value="Jibia">Jibia</option>
                                <option value="Kafur">Kafur</option>
                                <option value="Kaita">Kaita</option>
                                <option value="Kankara">Kankara</option>
                                <option value="Kankia">Kankia</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kurfi">Kurfi</option>
                                <option value="Kusada">Kusada</option>
                                <option value="Mai'aduwa">Mai'aduwa</option>
                                <option value="Malumfashi">Malumfashi</option>
                                <option value="Mani">Mani</option>
                                <option value="Mashi">Mashi</option>
                                <option value="Matazu">Matazu</option>
                                <option value="Musawa">Musawa</option>
                                <option value="Rimi">Rimi</option>
                                <option value="Sabuwa">Sabuwa</option>
                                <option value="Safana">Safana</option>
                                <option value="Sandamu">Sandamu</option>
                                <option value="Zango">Zango</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="town">Home Town</label>
                            <input type="text" class="form-control" id="town" name="town" required>
                        </div>


                        <div class="form-group">
                            <label for="healthStatus">Health Status</label>
                            <input type="text" class="form-control" id="healthStatus" name="healthStatus" required>
                        </div>

                        <!-- Repeat similar code for other fields -->

                        <!-- <div class="form-group">
                            <label for="pictureFile">Picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="pictureFile" name="pictureFile">
                                <label class="custom-file-label" for="pictureFile">Choose file...</label>
                            </div>
                        </div> -->

                        <button type="submit" class="btn btn-primary">Add Alhaji</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection