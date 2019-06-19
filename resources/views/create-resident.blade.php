@extends('layouts.app')
@section('title', session('sess_room_no'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Client Information Sheet</h3>1 of 3
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/residents" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="row">
                 <div class="float-right col-md-3">
                    <p>Unit No: <b>{{session('sess_room_building')}} {{session('sess_room_no')}}</b></p>    
                </div>

                <div class="float-right col-md-3">
                    <p>Beds: <b>{{session('sess_no_of_beds')}}</b></p>    
                </div>
            </div>
            <h5>PERSONAL INFORMATION </h5>

             <div class="row">

                <div class="col-md-4">
                    <input type="text" value="{{session('sess_first_name')}}" class="form-control" name="first_name" value="" placeholder="First Name">
                </div>

                <div class="col-md-4">
                    <input type="text" value="{{session('sess_last_name')}}" class="form-control" name="last_name" placeholder="Last Name">
                </div>

                <div class="col-md-4">
                    <input type="text" vale="{{session('sess_middle_name')}}" class="form-control" name="middle_name" placeholder="Middle Name">
                </div>
            </div>

            <br>
            <div class="row">
                
                <div class="col-md-3">
                    <label for="">Birthdate</label>
                    <input type="date" name="birthdate" value="{{ session('sess_birthdate') }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="" selected>Select One</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>

                
                <div class="col-md-3">
                    <label for="">Civil Status</label>
                    <select name="civil_status" class="form-control">
                        <option value="" selected>Select One</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="D">D</option>
                    </select>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-md-3">
                    <label for="">Nationality</label>
                    <input type="text" name="nationality" value="{{ session('sess_nationality') }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">Ethnicity</label>
                    <input type="text" name="ethinicity" value="{{ session('sess_ethnicity') }}" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">ID Presented/ID Number</label>
                    <input type="text" name="idInfo" value="{{ session('sess_idInfo') }}" class="form-control">
                </div>
            </div>

            
             <br>
                <h5>PERMANENT ADDRESS</h5>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" name="house_number" value="{{ session('sess_house_number') }}" class="form-control" placeholder="House number">
                    </div>

                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="barangay" class="form-control" value="{{ session('sess_barangay') }}" placeholder="Barangay">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="municipality" class="form-control" value="{{ session('sess_municipality') }}" placeholder="Municipality">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="province" class="form-control" value="{{ session('sess_province') }}" placeholder="Province">
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="zip" class="form-control" value="{{ session('sess_zip') }}" placeholder="Zip">
                    </div>
                </div>
                <br>

                <h5>CONTACT DETAILS</h5>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="mobileNumber" value="{{ session('sess_mobile_number') }}" class="form-control" placeholder="Mobile Number">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="telephone_number" class="form-control" value="{{ session('sess_telephone_number') }}" placeholder="Telephone Number">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="email_address" class="form-control" value="{{ session('sess_email_address') }}" placeholder="Email Address"> 
                    </div>
                </div>
                <br>
                <h5>IN CASE OF EMERGENCY PLEASE CONTACT</h5>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="name" value="{{ session('sess_name') }}" class="form-control" placeholder="Name of guardian">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="relationship" class="form-control" value="{{ session('sess_relationship') }}" placeholder="Relationship with the resident">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="guardian_mobile_number" class="form-control" value="{{ session('sess_guardian_mobile_number') }}" placeholder="Contact details"> 
                    </div>
                </div>
                <hr>
                <div class="card-footer">
                    <a class="float-left btn btn-primary" href="/rooms/{{session('sess_room_id')}}"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
                    <button type="submit" class="float-right btn btn-primary"><i class="fas fa-arrow-circle-right"></i>&nbspNEXT</button>
                <br>
                </div>
        </form>
        </div>
</div>
<br>
@endsection