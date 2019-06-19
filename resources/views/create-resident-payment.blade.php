@extends('layouts.app')
@section('title', session('sess_room_no'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Payment Information</h3>3 of 3
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/payments">
            {{ csrf_field() }}
            <div class="row">
                <div class="float-right col-md-3">
                    <p>Date of transaction: <b>{{Carbon\Carbon::parse(  session('sess_trans_date') )->formatLocalized('%b %d %Y')}}</b></p> 
                </div>
             </div>
             <div class="row">
                <div class="float-right col-md-3">
                   <p>Client: <b>{{session('sess_first_name')}} {{session('sess_middle_name')}} {{session('sess_last_name')}}</b></p>    
               </div>

               <div class="float-right col-md-3">
                    <p>Unit No: <b>{{session('sess_room_building')}} {{session('sess_room_no')}}</b></p>    
                </div>
                <div class="float-right col-md-3">
                    <p>Beds: <b>{{session('sess_no_of_beds')}}</b></p>    
                </div>
           </div>


           <div class="row">      
               <div class="col-md-4">
                   <p>Duration of Contract: <b>{{Carbon\Carbon::parse(  session('sess_move_in_date') )->formatLocalized('%b %d %Y')}} </b> - <b>{{Carbon\Carbon::parse(  session('sess_move_out_date') )->formatLocalized('%b %d %Y')}}</b></p>
               </div>

               <div class="col-md-3">
                   <p>Term: <b>{{session('sess_term')}}</b></p>
               </div>

               <div class="col-md-3">
                       <?php $start=Carbon\Carbon::parse(session('sess_move_in_date')); ?>
                       <?php $end=Carbon\Carbon::parse(session('sess_move_out_date')); ?>
                       <?php $durationInMonths = $start->diffInMonths($end); ?>
                   <p>Number of months: <b>{{$durationInMonths}}</b></p>
               </div>
           </div>

           <div class="row">      
                <div class="col-md-3">
                <p>Payment to be settled: <b>{{ number_format(session('sess_total'), 2) }}</b></p>
                </div>
            </div>

            <h5>PAYMENT BREAKDOWN</h5>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Security Deposit For Rent</label>
                    <input type="number" class="form-control" name="sec_dep_rent" value="{{session('sess_sec_dep_rent')}}"> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="">Security Deposit for Utilities</label>
                    <input type="number" class="form-control" name="sec_dep_utilities" value="{{session('sess_sec_dep_utilities')}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="">Advance Rent</label>
                    <input type="number" class="form-control" name="advance_rent" value="{{session('sess_advance_rent')}}">
                </div>
            </div>
                
            <div class="row">
                <div class="col-md-3">
                    <label for="">Transient</label>
                    <input type="number" class="form-control" name="transient" value="{{session('sess_transient')}}">
                </div>
            </div>
            <hr>
            
        <div class="card-footer">
            <a class="float-left btn btn-primary" href="/transactions/create"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
            <button type="submit" class="float-right btn btn-primary"><i class="fas fa-arrow-circle-right"></i>&nbspFINISH</button>
        <br>
        </div>
        </form>
        </div>
</div>
<br>
@endsection