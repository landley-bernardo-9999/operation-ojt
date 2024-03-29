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
                <div class="col-md-3">
                    <p>Client: <b>{{session('sess_first_name')}} {{session('sess_middle_name')}} {{session('sess_last_name')}}</b></p>    
                </div>
                <div class="col-md-3">
                    <p>Unit No: <b>{{session('sess_room_building')}} {{session('sess_room_no')}}</b></p>   
                    <input type="hidden" name="building" id="building" value="{{ session('sess_room_building') }}" readonly class="form-control">  
                </div>
                <div class="col-md-3">
                    <p>Beds: <b>{{session('sess_no_of_beds')}}</b></p>    
                </div>
             </div>
             
             <label for="">Contract Period</label>
             <div class="row">
                 <div class="col-md-2">
                     From<input type="date" class="form-control" name="move_in_date" id="move_in_date" required>
                 </div>
 
                <div class="col-md-2">
                     To<input type="date" class="form-control" value="" name="move_out_date" id="move_out_date" onkeyup="select_term()" required>
                 </div>
 
                 <div class="col-md-2">
                    Term<input type="text" name="term" id="term" readonly class="form-control">
                 </div>

                 <input type="hidden" name="yes" value="adding_room">
                 
             </div>
            
            <br>

            <div class="row" id="payment_info">
            <label for="">PAYMENT BREAKDOWN</label>
              <div class="col-md-12">
                  <table class="table">
                  <tr>
                      <td  id="sec_dep_rent_label">Security Deposit for Rent:</td>
                      <td><input type="text" class="form-control" style="width:30%" id="sec_dep_rent" name="sec_dep_rent" value="0.00" onkeyup="compute_total()"> </td>
                  </tr>
                  <tr>
                      <td  id="sec_dep_utilities_label">Security Deposit for Utilities:</td>
                      <td><input type="text" class="form-control" style="width:30%" id="sec_dep_utilities" name="sec_dep_utilities" value="0.00" onkeyup="compute_total()"></td>
                  </tr>
                  <tr>
                      <td id="advance_rent_label">Advance Rent:</td>
                      <td><input type="text" class="form-control" style="width:30%" id="advance_rent" name="advance_rent" value="0.00" onkeyup="compute_total()"></td>
                  </tr>
                  <tr>
                      <td id="transient_label">Transient:</td>
                      <td><input type="text" class="form-control" style="width:30%" id="transient" name="transient" value="0.00" onkeyup="compute_total()"></td>
                  </tr>
                  <tr>
                      <th>TOTAL</th>
                      <td><input type="number" class="form-control" style="width:30%" id="total_payment" name="total_payment" value="0.00" readonly></td>
                  </tr>
              </table>
              </div>
            </div>
            
                <hr>
                <div class="card-footer">
                    <a class="btn-default" href="/residents/create"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
                    <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-check-circle"></i>&nbspSUBMIT</button>
                <br>
                </div>
        </form>
        </div>
</div>
<br>
<script>

window.onload = function() {
        document.getElementById('payment_info').style.display = 'none';
    }

    function compute_total(){
        var sec_dep_rent=document.getElementById('sec_dep_rent').value;
        var sec_dep_utilities=document.getElementById('sec_dep_utilities').value;
        var advance_rent=document.getElementById('advance_rent').value;
        var transient=document.getElementById('transient').value;   

        document.getElementById('total_payment').value = parseFloat(sec_dep_rent) + parseFloat(sec_dep_utilities) + parseFloat(advance_rent) + parseFloat(transient);
    }

    function select_term(){    
        
        var move_in_date = document.getElementById('move_in_date').value =  document.getElementById('trans_date').value;
        var move_out_date = document.getElementById('move_out_date').value;
        var building = document.getElementById('building').value;

        var d1 = new Date(move_in_date);
        var d2 = new Date(move_out_date);
        var timeDiff = d2.getTime() - d1.getTime();
        var DaysDiff = timeDiff / (1000 * 3600 * 24);

        if(DaysDiff => 180 && DaysDiff > 28){
            document.getElementById('term').value =   'long_term' ;
        }

        if(DaysDiff < 180 && DaysDiff > 28){
            document.getElementById('term').value =  'short_term' ;
        }

        if(DaysDiff <= 28 ){
            document.getElementById('term').value = 'transient' ;
        }

        //computation for the payment in harvard
        if( building === 'harvard'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 6800*2;
                var advance_rent = document.getElementById('advance_rent').value = 6800;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
          
               
                document.getElementById('total_payment').value = total_payment;

            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 7800;
                var advance_rent = document.getElementById('advance_rent').value = 7800;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
           

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 1200 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;
                document.getElementById('payment_info').style.display = 'block';
                document.getElementById('transient_label').style.display = 'none';

                document.getElementById('total_payment').value = total_payment;
            }

        }

        //computation of payment for princeton.
        else if( building === 'princeton'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 7500*2;
                var advance_rent = document.getElementById('advance_rent').value = 7500;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;

                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 8500;
                var advance_rent = document.getElementById('advance_rent').value = 8500;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
             

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 1200 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;
                document.getElementById('payment_info').style.display = 'block';

                document.getElementById('total_payment').value = total_payment;
            }

        }

        //computation of payment fo wharton.
        else if( building === 'wharton'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 1100*2;
                var advance_rent = document.getElementById('advance_rent').value = 1000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;

                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 12000;
                var advance_rent = document.getElementById('advance_rent').value = 12000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
             

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 1500 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;
                document.getElementById('payment_info').style.display = 'block';

                document.getElementById('total_payment').value = total_payment;
            }

        }

        //computation of payment fo manors.
        else if( building === 'manors'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 16000;
                var advance_rent = document.getElementById('advance_rent').value = 16000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;

                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 17000;
                var advance_rent = document.getElementById('advance_rent').value = 17000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
             

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 2000 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;
                document.getElementById('payment_info').style.display = 'block';

                document.getElementById('total_payment').value = total_payment;
            }

        }

        //computation of payment fo loft.
         else if( building === 'loft'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 13000;
                var advance_rent = document.getElementById('advance_rent').value = 13000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;

                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 14000;
                var advance_rent = document.getElementById('advance_rent').value = 14000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
             

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 2000 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;
                document.getElementById('payment_info').style.display = 'block';

                document.getElementById('total_payment').value = total_payment;
            }

        }

         //computation of payment fo arkansas.
         else if( building === 'arkansas'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 12000;
                var advance_rent = document.getElementById('advance_rent').value = 12000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;

                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 13000;
                var advance_rent = document.getElementById('advance_rent').value = 13000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
             

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 2000 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;
                document.getElementById('payment_info').style.display = 'block';

                document.getElementById('total_payment').value = total_payment;
            }

        }

         //computation of payment fo colorado.
          else if( building === 'colorado'){
            if( document.getElementById('term').value === 'long_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 15000;
                var advance_rent = document.getElementById('advance_rent').value = 15000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;

                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';

                document.getElementById('total_payment').value = total_payment;
            }
            else if( document.getElementById('term').value === 'short_term'){
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 16000;
                var advance_rent = document.getElementById('advance_rent').value = 16000;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 2000;
                var transient = document.getElementById('transient').value = 0;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities;
                document.getElementById('transient').style.display = 'none';
                document.getElementById('transient_label').style.display = 'none';
             

                document.getElementById('total_payment').value = total_payment;
            }
            else{
                var sec_dep_rent = document.getElementById('sec_dep_rent').value = 0;
                var advance_rent = document.getElementById('advance_rent').value = 0;
                var sec_dep_utilities = document.getElementById('sec_dep_utilities').value = 0;
                var transient = document.getElementById('transient').value = 2000 * DaysDiff;

                var total_payment = sec_dep_rent + advance_rent + sec_dep_utilities + transient;
                document.getElementById('payment_info').style.display = 'block';

                document.getElementById('total_payment').value = total_payment;
            }

        }
    }
</script>
@endsection