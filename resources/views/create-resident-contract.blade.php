@extends('layouts.app')
@section('title',session('sess_room_no'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Leasing Agreement</h3>2 of 3
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/transactions">
            {{ csrf_field() }}
            <div class="row">
                <div class="float-right col-md-3">
                     <label for="">Date of transaction</label>
                    <input type="date" name="trans_date" id="" value="{{date('Y-m-d')}}" class="form-control">   
                </div>
             </div>
             <br>
             <div class="row">
                  <div class="float-right col-md-3">
                     <p>Client: <b>{{session('sess_first_name')}} {{session('sess_middle_name')}} {{session('sess_last_name')}}</b></p>    
                 </div>
             </div>
 
             <div class="row">
                  <div class="float-right col-md-3">
                     <p>Unit No: <b>{{session('sess_room_building')}} {{session('sess_room_no')}}</b></p>    
                 </div>
                 <div class="float-right col-md-3">
                     <p>Beds: <b>{{session('sess_no_of_beds')}}</b></p>    
                 </div>
             </div>
             
             <div class="row">
                 <div class="col-md-3">
                     <label for="">From</label>
                     <input type="date" class="form-control" value="{{ session('sess_move_in_date') }}" name="move_in_date" id="move_in_date" required>
                 </div>
 
                <div class="col-md-3">
                     <label for="">To</label>
                     <input type="date" class="form-control" value="" name="move_out_date" id="move_out_date" onkeyup="select_term()" required>
                 </div>
 
                 <div class="col-md-2">
                     <label for="">Term</label>
                    <input type="text" name="term" id="term" readonly class="form-control">
                 </div>
             </div>
            
                <hr>
                <div class="card-footer">
                    <a class="float-left btn btn-primary" href="/residents/create"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
                    <button type="submit" class="float-right btn btn-primary"><i class="fas fa-arrow-circle-right"></i>&nbspNEXT</button>
                <br>
                </div>
        </form>
        </div>
</div>
<br>
@endsection

<script>
 function select_term(){    
        var move_in_date = document.getElementById('move_in_date').value;
        var move_out_date = document.getElementById('move_out_date').value;

        var d1 = new Date(move_in_date);
        var d2 = new Date(move_out_date);
        var timeDiff = d2.getTime() - d1.getTime();
        var DaysDiff = timeDiff / (1000 * 3600 * 24);

        if(DaysDiff => 180 && DaysDiff > 29){
            document.getElementById('term').value =  'long_term';
        }

        if(DaysDiff < 180 && DaysDiff > 29){
            document.getElementById('term').value =  'short_term';
        }

        if(DaysDiff <= 29 ){
            document.getElementById('term').value =  'transient' ;
        }
     



    }
</script>