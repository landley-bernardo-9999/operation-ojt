@extends('layouts.app')
@section('title',  $owner->owner_first_name." ".$owner->owner_last_name)
@section('content')
<div class="container">
        <form class="form-horizontal" method="POST" action="/owners/{{ $owner->owner_id }}">
            @method('PATCH')
            {{ csrf_field() }}
    <div class="row">
       <div class="col-md-9">
            <table class="table">
                <tr>
                    <h3>Personal Information</h3>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="owner_first_name" value="{{ $owner->owner_first_name }}" class="form-control"></td>
                    <td><input type="text" name="owner_middle_name" value="{{ $owner->owner_middle_name }}" class="form-control"></td>
                    <td><input type="text" name="owner_last_name" value="{{ $owner->owner_last_name }}" class="form-control"></td>
                </tr>
                <tr>
                    <td>Birthdate:</td>
                    <td>
                        <input type="date" name="owner_birthdate" value="{{ $owner->owner_birthdate }}" class="form-control">  
                    </td>
                </tr>    
                <tr>
                    <td>Gender:</td>
                    <td>
                        <select name="owner_gender" id="" class="form-control">
                            <option value="{{ $owner->owner_gender }}">{{ $owner->owner_gender }}</option>
                            <option value="M">M</option>
                            <option value="F">F</option>    
                        </select>    
                    </td>
                </tr>
                <tr>
                    <td>Civil Status:</td>
                    <td>
                        <select name="owner_civil_status" id="" class="form-control">
                            <option value="{{ $owner->civil_status }}">{{ $owner->owner_status }}</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="W">W</option>
                            <option value="D">D</option>    
                        </select>  
                    </td>
                </tr>
                <tr>
                    <td>Nationality:</td>
                    <td><input type="text" name="owner_nationality" value="{{ $owner->owner_nationality }}" class="form-control">  </td>
                </tr>
                <tr>
                    <td>Ethnicity:</td>
                    <td><input type="text" name="owner_ethnicity" value="{{ $owner->owner_ethnicity }}" class="form-control">  </td>
                </tr>
                <tr>
                    <td>ID Information:</td>
                    <td><input type="text" name="owner_id_info" value="{{ $owner->owner_id_info }}" class="form-control">  </td>
                </tr>
            </table>
       </div>

       <div class="col-md-3">
          
       </div>
    </div>

     <div class="row">
        <table class="table">
                <tr>
                    <h3>Address</h3>
                </tr>
                <tr>
                    <td>House Number:</td>
                    <td><input type="text" name="owner_house_number" value="{{ $owner->owner_house_number }}" class="form-control"> </td>
                </tr>
                <tr>
                    <td>Barangay:</td>
                    <td><input type="text" name="owner_barangay" value="{{ $owner->owner_barangay }}" class="form-control"> </td>
                </tr>
                <tr>
                    <td>Municipality:</td>
                    <td><input type="text" name="owner_municipality" value="{{ $owner->owner_municipality }}" class="form-control"> </td>
                </tr>
                <tr>
                    <td>Province:</td>
                    <td><input type="text" name="owner_province" value="{{ $owner->owner_province }}" class="form-control"> </td>
                </tr>
                <tr>
                    <td>Zip Code:</td>
                    <td><input type="text" name="owner_zip" value="{{ $owner->owner_zip }}" class="form-control"> </td>
                </tr>
            </table>
        </div>

       <div class="row">
            <table class="table">
                <tr>
                    <h3>Contact Details</h3>
                </tr>
                <tr>
                    <td>Mobile Number:</td>
                    <td><input type="text" name="owner_mobile_number" value="{{ $owner->owner_mobile_number }}" class="form-control"> </td>
                    </tr>
                <tr>
                    <td>Telephone Number:</td>
                    <td><input type="text" name="owner_telephone_number" value="{{ $owner->owner_telephone_number }}" class="form-control"> </td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td><input type="text" name="owner_email_address" value="{{ $owner->owner_email_address }}" class="form-control"> </td>
                </tr>
            </table>
        </div>

        <div class="row">
            <table class="table">
               <tr>
                   <h3>Representative</h3>
               </tr>
               @foreach ($representative as $representative)
               <tr>
                    <td>Name:</td>
                    <td><input type="text" name="rep_name" value="{{ $representative->rep_name }}" class="form-control"> </td>
               </tr>
               <tr>
                    <td>Relationship with the Unit Owner:</td>
                    <td><input type="text" name="rep_relationship" value="{{ $representative->rep_relationship }}" class="form-control"> </td>
               </tr>
               <tr>
                    <td>Mobile Number:</td>
                    <td><input type="text" name="rep_mobile_number" value="{{ $representative->rep_mobile_number }}" class="form-control"> </td>
               </tr>
               @endforeach
            </table>
        </div>

    <div class="row">
            <table class="table">
               <tr>
                   <h3>Bank Details</h3>
               </tr>
               @foreach ($bank as $bank)
               <tr>
                    <td>Bank Name:</td>
                    <td><input type="text" name="bank_name" value="{{ $bank->bank_name }}" class="form-control"> </td>
               </tr>
               <tr>
                    <td>Bank Account Name:</td>
                    <td><input type="text" name="bank_account_name" value="{{ $bank->bank_account_name }}" class="form-control"> </td>
               </tr>
               <tr>
                    <td>Bank Account Number:</td>
                    <td><input type="text" name="bank_account_number" value="{{ $bank->bank_account_number }}" class="form-control"> </td>
               </tr>
               @endforeach
            </table>

        </div>
        <a href="{{ URL::previous() }}" class="btn btn-danger"></i>CANCEL</a>           
        <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');">SAVE</button>  
    </form>
</div>
<br>
@endsection
