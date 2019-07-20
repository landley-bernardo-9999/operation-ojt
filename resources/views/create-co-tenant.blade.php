@extends('layouts.app')
@section('title', session('sess_room_no'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Client Information Sheet <span><h5 style="width:7%" class="btn-success">(co-tenant)</h5></span></h3>
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/residents" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="col-md-3">
                    <p>Resident Name: <b>{{session('resident_name')}} </b></p>    
                </div>
                 <div class="col-md-3">
                    <p>Unit No: <b>{{session('sess_room_building')}} {{session('sess_room_no')}}</b></p>    
                </div>

            </div>
            <h5>PERSONAL INFORMATION </h5>

             <div class="row">

                <div class="col-md-4">
                    <input type="text" value="" class="form-control" name="first_name" placeholder="First Name">
                </div>

                <div class="col-md-4">
                    <input type="text" value="" class="form-control" name="last_name" placeholder="Last Name">
                </div>

                <div class="col-md-4">
                    <input type="text" vale="" class="form-control" name="middle_name" placeholder="Middle Name">
                </div>
            </div>
            
                <h5>CONTACT DETAILS</h5>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="mobile_number" value="" class="form-control" placeholder="Mobile Number">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="telephone_number" class="form-control" value="" placeholder="Telephone Number">
                    </div>

                    <div class="col-md-4">
                        <input type="email" name="email_address" class="form-control" value="" placeholder="Email Address"> 
                    </div>

                    <input type="hidden" name="type_of_resident" class="form-control" value="co_resident"> 
                </div>
        
                <hr>
                <div class="card-footer">
                    <a class="btn-default" href="/residents/{{session('resident_id')}}">BACK</a>
                    <button type="submit" class="btn-default">SAVE</button>
                <br>
                </div>
        </form>
        </div>
</div>
<br>
@endsection