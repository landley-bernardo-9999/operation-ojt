@extends('layouts.app')
@section('title', session('resident_name'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>ADD ROOM TO RESIDENT</h3>
            <p>Resident: <b>{{session('resident_name')}}</b></p>  
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/transactions">
            {{ csrf_field() }}
            <div class="row">
                <div class="float-right col-md-3">
                    Date of transaction:<input type="date" name="trans_date" id="" value="{{date('Y-m-d')}}" class="form-control">   
                </div>

                 <div class="col-md-3">
                     Unit No:<select class="form-control" name="room_id" id="">
                         <option value="">Select Unit</option>
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
                     <input type="date" class="form-control" value="{{ session('sess_move_out_date') }}" name="move_out_date" required>
                 </div>
 
                 <div class="col-md-4">
                     <label for="">Term</label>
                     <select name="term" id="" class="form-control" required>
                         <option value="">Select Term</option>
                         <option value="long_term">Long Term</option>
                         <option value="short_term">Short Term</option>
                         <option value="transient">Transient</option>
                     </select>
                 </div>
             </div>
            <br>
      
                <hr>
            <div class="card-footer">
                <a class="float-left btn btn-primary" href="/residents/{{session('resident_id')}}"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
                <button type="submit" class="float-right btn btn-primary"><i class="fas fa-arrow-circle-right"></i>&nbspNEXT</button>
            <br>
        </div>
        </form>
    </div>
</div>
<br>
@endsection