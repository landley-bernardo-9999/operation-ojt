@extends('layouts.app')
@section('title', session('resident_name'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>ADD/TRANSFER ROOM</h3>
            <p>Resident: <b>{{session('resident_name')}}</b></p>  
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/transactions">
            {{ csrf_field() }}
            <div class="row">
                <div class="float-right col-md-3">
                    Date of transaction:<input type="date" name="trans_date" id="" value="{{ session('sess_trans_date') }}" class="form-control" required>   
                </div>

                 <div class="col-md-3">
                     Unit No:<select class="form-control" name="room_id" id="">
                         <option value="{{ session('sess_room_id') }}">{{ session('sess_room_building') }} {{ session('sess_room_no') }}</option>
                         @foreach ($rooms as $room)
                             <option value="{{ $room->room_id }}">{{ $room->building }} {{ $room->room_no }} </option>
                         @endforeach
                     </select>
                 </div>

                 <input type="hidden" name="adding_room" value="yes">
            </div>
            <br>
        
             <h5>DURATION OF CONTRACT</h5>
            <div class="row">
                 <div class="col-md-4">
                     <label for="">From</label>
                     <input type="date" class="form-control" value="{{ session('sess_move_in_date') }}" name="move_in_date" required>
                 </div>
 
                <div class="col-md-4">
                     <label for="">To</label>
                     <input type="date" class="form-control" value="{{ session('sess_move_in_date') }}" name="move_out_date" required>
                 </div>
 
                 <div class="col-md-4">
                     <label for="">Term</label>
                     <select name="term" id="" class="form-control" required>
                         <option value="">Select Term</option>
                         <option value="{{ session('sess_term') }}" selected>{{ session('sess_term')}}</option>
                         <option value="long_term">Long Term</option>
                         <option value="short_term">Short Term</option>
                         <option value="transient">Transient</option>
                     </select>
                 </div>

                 
             </div>
            
             @if(session('sess_adding_room')=='yes')   
             <input type="hidden" name="adding_room" value="no">
             <br>
             <div class="row">      
                <div class="col-md-3">
                <p>PAYMENT TO BE SETTLED: <b>{{ number_format(session('sess_total'), 2) }}</b></p>
                </div>
            </div>

             <h5>PAYMENT BREAKDOWN</h5>
             @if(session('sess_sec_dep_rent') > 0 )
             <div class="row">
                 <div class="col-md-3">
                     <label for="">Security Deposit For Rent</label>
                     <input type="number" class="form-control" name="sec_dep_rent" value="{{session('sess_sec_dep_rent')}}"> 
                 </div>
             </div>
             @endif
 
             @if(session('sess_sec_dep_utilities') > 0 )
             <div class="row">
                 <div class="col-md-3">
                     <label for="">Security Deposit for Utilities</label>
                     <input type="number" class="form-control" name="sec_dep_utilities" value="{{session('sess_sec_dep_utilities')}}">
                 </div>
             </div>
             @endif
 
             @if(session('sess_advance_rent') > 0 )
             <div class="row">
                 <div class="col-md-3">
                     <label for="">Advance Rent</label>
                     <input type="number" class="form-control" name="advance_rent" value="{{session('sess_advance_rent')}}">
                 </div>
             </div>
             @endif
              
             @if(session('sess_transient') > 0 )
             <div class="row">
                 <div class="col-md-3">
                     <label for="">Transient</label>
                     <input type="number" class="form-control" name="transient" value="{{session('sess_transient')}}">
                 </div>
             </div>
             @endif
             
             <hr>
             <a href="/transactions/clear_fields/" class="btn btn-danger">CLEAR FIELDS</a>
             <button type="submit" class="btn btn-default">SAVE</button>
             @else
             <hr>
             <button type="submit" >COMPUTE PAYMENT</button>
             @endif
            <div class="card-footer">
                {{-- <a class="btn btn-primary" href="/residents/{{session('resident_id')}}"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a> --}}
        </div>
        </form>
    </div>
</div>
<br>
@endsection