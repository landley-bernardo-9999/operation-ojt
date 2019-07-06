@extends('layouts.app')
@section('title',session('sess_room_no'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Client Information Sheet</h3>
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/owners" enctype="multipart/form-data">
            {{ csrf_field() }}
            
             <div class="row">
                 <div class="float-right col-md-3">
                    <p>Unit No: <b>{{session('sess_room_building')}} {{session('sess_room_no')}}</b></p>    
                </div>

                <div class="float-right col-md-3">
                    <p>No of Beds: <b>{{session('sess_no_of_beds')}}</b></p>    
                </div>
            </div>
            <h5>PERSONAL INFORMATION </h5>
             <div class="row">
                <div class="col-md-4">
                    <input type="text" value="{{ old('owner_first_name') }}" class="form-control" name="owner_first_name" value="" placeholder="First Name">
                </div>

                <div class="col-md-4">
                    <input type="text" value="{{ old('owner_last_name') }}" class="form-control" name="owner_last_name" placeholder="Last Name">
                </div>

                <div class="col-md-4">
                    <input type="text" vale="{{ old('owner_first_name') }}" class="form-control" name="owner_middle_name" placeholder="Middle Name">
                </div>
            </div>

            <br>
            <div class="row">
                
                <div class="col-md-3">
                    <label for="">Birthdate</label>
                    <input type="date" name="owner_birthdate" value="" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">Gender</label>
                    <select name="owner_gender" class="form-control">
                        <option value="" selected>Select Gender</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>

                
                <div class="col-md-3">
                    <label for="">Civil Status</label>
                    <select name="owner_civil_status" class="form-control">
                        <option value="" selected>Select Civil Status</option>
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
                    <input type="text" value="{{ old('owner_nationality') }}" name="owner_nationality" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">Ethnicity</label>
                    <input type="text" value="{{ old('owner_ethnicity') }}" name="owner_ethnicity" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="">ID Presented/ID Number</label>
                    <input type="text" value="{{ old('owner_id_info') }}" name="owner_id_info" class="form-control">
                </div>
            </div>

            
             <br>
                <h5>PERMANENT ADDRESS</h5>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" value="{{ old('owner_house_number') }}" name="owner_house_number" class="form-control" placeholder="House number">
                    </div>

                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" value="{{ old('owner_barangay') }}" class="form-control" name="owner_barangay" placeholder="Barangay">
                    </div>

                    <div class="col-md-3">
                        <input type="text" value="{{ old('owner_municipality') }}" class="form-control" name="owner_municipality" placeholder="Municipality">
                    </div>

                    <div class="col-md-3">
                        <input type="text" value="{{ old('owner_province') }}" class="form-control" name="owner_province" placeholder="Province">
                    </div>

                    <div class="col-md-2">
                        <input type="text" value="{{ old('owner_zip') }}" name="" class="form-control" name="owner_zip" placeholder="Zip">
                    </div>
                </div>
                <br>

                <h5>CONTACT DETAILS</h5>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" value="{{ old('owner_mobile_number') }}" name="owner_mobile_number" class="form-control" placeholder="Mobile Number">
                    </div>

                    <div class="col-md-4">
                        <input type="text" value="{{ old('owner_telephone_number') }}" name="owner_telephone_number" class="form-control"  placeholder="Telephone Number">
                    </div>

                    <div class="col-md-4">
                        <input type="text" value="{{ old('owner_email_address') }}" name="owner_email_address" class="form-control" placeholder="Email Address"> 
                    </div>
                </div>
                <br>
                <h5>BANK DETAILS</h5>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" value="{{ old('bank_name') }}" name="bank_name" class="form-control" placeholder="Name of the bank">
                    </div>

                    <div class="col-md-4">
                        <input type="text" value="{{ old('bank_account_name') }}" name="bank_account_name" class="form-control" value="" placeholder="Bank Account Name">
                    </div>

                    <div class="col-md-4">
                        <input type="text" value="{{ old('bank_account_number') }}" name="bank_account_number" class="form-control" placeholder="Bank Account Number "> 
                    </div>
                </div>

                <br>
                <h5>REPRESENTATIVE OF THE UNIT OWNER</h5>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="rep_name" value="{{ old('rep_name') }}" class="form-control" placeholder="Name of representative">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="rep_relationship" value="{{ old('rep_relationship') }}" class="form-control" placeholder="Relationship with the unit owner">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="rep_mobile_number" value="{{ old('rep_mobile_number') }}" class="form-control" placeholder="Contact details"> 
                    </div>
                </div>
                <br>
                <h5>CONTRACT INFORMATION</h5>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Enrollment Date:</label>
                        <input type="date" name="enrollment_date" value="{{ old('enrollment_date') }}" class="form-control">
                    </div>

                </div>
                <br>
                <div class="card-footer">
                    <a class="btn-default" href="{{ URL::previous() }}"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
                    <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-arrow-circle-right"></i>&nbspSAVE</button>
                <br>
                </div>
        </form>
        </div>
</div>
<br>
@endsection