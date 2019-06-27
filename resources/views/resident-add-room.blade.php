@extends('layouts.app')
@section('title',session('sess_room_no'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Leasing Agreement</h3>
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/transactions">
            {{ csrf_field() }}
            <div class="row">
                <div class="float-right col-md-2">
                     <label for="">Date of transaction</label>
                    <input type="date" name="trans_date" id="trans_date" value="{{date('Y-m-d')}}" onkeyup="select_term()" class="form-control">   
                </div>
             </div>
             <br>
             <div class="row">
                <div class="col-md-2">
                    <p>Client: <b>{{session('sess_first_name')}} {{session('sess_middle_name')}} {{session('sess_last_name')}}</b></p>    
                </div>
                 <div class="col-md-2">
                     Building<select class="form-control" name="building" id="building" required >
                         <option value="">Select Building</option>
                         <option value="harvard">Harvard</option>
                         <option value="princeton">Princeton</option>
                         <option value="arkansas">Arkansas</option>
                         <option value="colorado">Colorado</option>
                         <option value="loft">Loft</option>
                         <option value="manors">Manors</option>
                     </select>
                 </div>
                 <div class="col-md-2">
                     Unit No<select class="form-control" name="room_id" id="" required>
                         <option value="">Select Unit</option>
                         @foreach ($rooms as $room)
                             <option value="{{ $room->owner_id }} {{ $room->room_id }}"> {{ $room->room_no }} </option>
                         @endforeach
                     </select>
                 </div>
                 <input type="hidden" name="adding_room" value="yes">
             </div>
             
             <label for="">Contract Period</label>
             <div class="row">
                 <div class="col-md-2">
                     From: <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="move_in_date" id="move_in_date" required>
                 </div>
 
                <div class="col-md-2">
                     To: <input type="date" class="form-control" value="" name="move_out_date" id="move_out_date" onkeyup="select_term()" required>
                 </div>
 
                 <div class="col-md-2">
                    Term: <input type="text" name="term" id="term" readonly class="form-control">
                 </div>

                 <input type="hidden" name="yes" value="adding_room">
                 
             </div>
             
             <br>

            <label for="">Payment</label>
            <div class="row">
              <div class="col-md-12">
                  <table class="table">
                  <tr>
                      <td>Security Deposit for Rent:</td>
                      <td><input type="number" class="form-control" style="width:30%" id="sec_dep_rent" name="sec_dep_rent" value="0.00" > </td>
                  </tr>
                  <tr>
                      <td>Security Deposit for Utilities:</td>
                      <td><input type="number" class="form-control" style="width:30%" id="sec_dep_utilities" name="sec_dep_utilities" value="0.00" ></td>
                  </tr>
                  <tr>
                      <td>Advance Rent:</td>
                      <td><input type="number" class="form-control" style="width:30%" id="advance_rent" name="advance_rent" value="0.00" ></td>
                  </tr>
                  <tr>
                      <td>Transient:</td>
                      <td><input type="number" class="form-control" style="width:30%" id="transient" name="transient" value="0.00" ></td>
                  </tr>
                  <tr>
                      <th>Total</th>
                      <td><input type="number" class="form-control" style="width:30%" id="total_payment" name="total_payment" value="0.00" readonly></td>
                  </tr>
              </table>
              </div>
            </div>
            
                <hr>
                <div class="card-footer">
                    <a class="btn-default" href="/residents/create"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
                    <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-arrow-circle-right"></i>&nbspSAVE</button>
                <br>
                </div>
        </form>
        </div>
</div>
<br>
@endsection

<script>
 function select_term(){    
        var move_in_date = document.getElementById('move_in_date').value   = document.getElementById('trans_date').value; ;
        var move_out_date = document.getElementById('move_out_date').value;
        var building = document.getElementById('building').value;

        var d1 = new Date(move_in_date);
        var d2 = new Date(move_out_date);
        var timeDiff = d2.getTime() - d1.getTime();
        var DaysDiff = timeDiff / (1000 * 3600 * 24);

        if(DaysDiff => 180 && DaysDiff > 29){
            document.getElementById('term').value =   'long_term' ;
        }

        if(DaysDiff < 180 && DaysDiff > 29){
            document.getElementById('term').value =  'short_term' ;
        }

        if(DaysDiff <= 29 ){
            document.getElementById('term').value = 'transient' ;
        }

        //computation for the payment in harvard
        if( building === 'harvard'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 6800*2;
                var advance_rent = document.getElementById('advance_rent').value = 6800;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 7800;
                var advance_rent = document.getElementById('advance_rent').value = 7800;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 1200 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;

                document.getElementById('total_payment').value = total_payment;
            }

        }

        //computation of payment for princeton.
        if( building === 'princeton'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 7500*2;
                var advance_rent = document.getElementById('advance_rent').value = 7500;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 8500;
                var advance_rent = document.getElementById('advance_rent').value = 8500;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 1200 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;

                document.getElementById('total_payment').value = total_payment;
            }

        }

        //computation of payment fo wharton.
        if( building === 'wharton'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 11000*2;
                var advance_rent = document.getElementById('advance_rent').value = 11000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 12000;
                var advance_rent = document.getElementById('advance_rent').value = 12000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 2000 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;

                document.getElementById('total_payment').value = total_payment;
            }

        }

                //computation of payment fo wharton.
        if( building === 'manors'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 17000;
                var advance_rent = document.getElementById('advance_rent').value = 17000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 18000;
                var advance_rent = document.getElementById('advance_rent').value = 18000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 2000 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;

                document.getElementById('total_payment').value = total_payment;
            }

        }


     
    }

</script>