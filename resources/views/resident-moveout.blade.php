@extends('layouts.app')
@section('title', session('resident_name'))
@section('content')
<div class="container">
    <form method="POST" action="/transactions/{{ $transaction->trans_id }}">
        @method('PATCH')
    {{ csrf_field() }}
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="" href="/transactions/{{ $transaction->trans_id }}">Back</a>
            </li>
        </ul>
    </div>
    <div class="row">
         <tr>
            <h3>Moveout Form</h3>
        </tr>
        <table class="table">
             @foreach ($resident as $resident)
        <tr>
            <td>Resident Name:</td>
            <td>{{ $resident->first_name }} {{ $resident->last_name }}</td>
            <td>Unit No:</td>
            <td>{{ $resident->building }} {{ $resident->room_no }}</td>
        </tr>
            @endforeach
        <tr>
            <td>Contract Period:</td>
            <td>{{Carbon\Carbon::parse(  $transaction->move_in_date )->formatLocalized('%b %d %Y')}} - {{Carbon\Carbon::parse(  $transaction->move_out_date )->formatLocalized('%b %d %Y')}} ({{ $transaction->term }})</td>
            <td>Contract Status:</td>
            <td>{{ $transaction->trans_status }}</td>
        </tr>
        <tr>
            @if($transaction->trans_status == 'inactive')
            <td>Move Out Date:</td>
            <td>{{Carbon\Carbon::parse(  $transaction->actual_move_out_date )->formatLocalized('%b %d %Y')}}</td>
            <td>Reason:</td>
            <td>{{ $transaction->move_out_reason }}</td>    
            @else
            <td>Move Out Date:</td>
            <td> <input type="date" class="form-control" style="width:50%" name="actual_move_out_date" value="{{$transaction->move_out_date}}" required></<td>
            <input type="hidden" name="trans_status" value="inactive">
            <td>Reason:</td>
            <td>
                <select name="move_out_reason" id="" class="form-control" style="width:70%" required>
                    <option value="" selected>Select Reason</option>
                    <option value="end_of_contract">End of Contract</option>
                    <option value="force_majeure">Force Majeure</option>
                    <option value="run_away">Run Away</option>
                    <option value="delinquent">Delinquent</option>
                    <option value="unruly">Unruly</option>
                </select>
            </td>    
            @endif
        </tr>
       
        </table>

        <form method="POST" action="/transactions/{{ $transaction->trans_id }}">
            @method('PATCH')
        {{ csrf_field() }}
        <table class="table">
            <tr>
                <h3>Utility Readings</h3>
            </tr>
            <tr>
                <th><label for="">Water</label></th>
                <th></th>
                <th><label for="">Electric</label></th>
                <th></th>
            </tr>
            
            <tr>
                <td>Initial:  </td>
                <td>{{ $transaction->initial_water_reading }}</td>
                <td>Initial: </td>
                <td>{{ $transaction->initial_electric_reading }}</td>
            </tr>
            <tr>
                <td>Final: </td>
                <td> {{ $transaction->final_water_reading }}</td>
                <td>Final:  </td>
                <td>{{ $transaction->final_water_reading }}</td>
            </tr>
        </table>
        </form>
    
        <table class="table">
           <tr>
               <h3>Security Deposit</h3>
           </tr>
           <?php $row_no_payments_move_in = 1; ?>
           @if(!$payment_move_ins->count() > 0)
           <p class="text-danger">No Security Deposit.</p>
           @else
           <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            @foreach ($payment_move_ins as $payment)
            <tr>
                 <td>{{ $row_no_payments_move_in++ }}.</td>
                 <td> {{Carbon\Carbon::parse(  $payment->trans_date )->formatLocalized('%b %d %Y')}}</td>
                 <td>{{ $payment->desc }}</td>
                 <td>{{ number_format($payment->amt, 2) }}</td>
                 <td>{{ $payment->payment_status }}</td>
            </tr>
            @endforeach
            <tr>
                 <td><b>TOTAL</b></td>
                 <td></td>
                 <td></td>
                 <td><b>{{ number_format($payment_move_ins->sum('amt'), 2) }}</b></td>
                 <td></td>
             </tr>
           @endif
          
        </table>


        @if($transaction->trans_status == 'inactive')
         <table class="table">
           <tr>
               <h3>Move Out Charges</h3>
           </tr>
           <?php $row_no_payments_move_out = 1; ?>
           @if(!$payment_move_outs->count() > 0)
           <p class="text-danger">No Moveout Charges.</p>
           @else
           <tr>
               <th>No.</th>
               <th>Date</th>
               <th>Description</th>
               <th>Amount</th>
               <th>Status</th>
           </tr>
           @foreach ($payment_move_outs as $payment)
           <tr>
                <td>{{ $row_no_payments_move_out++ }}.</td>
                <td> {{Carbon\Carbon::parse(  $payment->trans_date )->formatLocalized('%b %d %Y')}}</td>
                <td>{{ $payment->desc }}</td>
                <td>{{ number_format($payment->amt, 2) }}</td>
                <td>{{ $payment->payment_status }}</td>
           </tr>
           @endforeach
           <tr>
               <td><b>TOTAL</b></td>
               <td></td>
               <td></td>
               <td><b>{{ number_format($payment_move_outs->sum('amt'), 2) }}</b></td>
               <td></td>
           </tr>
          @endif
        </table>
        @else
        <table class="table">
                <tr>
                   <h3>Move Out Charges</h3>
                </tr>
               <?php $row_no_payments = 1; ?>
                <tr>
                   <th>No.</th>
                   <th>Items/Materials</th>
                   <th>Remarks</th>
                   <th>Quantity</th>
                   <th>Amount</th>
                   <th>Total</th>
                </tr>
                <tr>
                   <td>1.</td>
                   <td>LAUNDRY</td>
                   <td>Comforter</td>
                   <td><input type="text" class="form-control" name="qty_comforter" id="qty_comforter" value = "0" style="width: 40%" onkeyup="sum_comforter()"></td>
                   <td><input type="text" class="form-control" name="amt_comforter" id="amt_comforter" value = "0" style="width: 40%" onkeyup="sum_comforter()"></td>
                   <td><input type="text" name="total_comforter" id="total_comforter" class="form-control" value = "0" style="width: 40%" readonly></td>
                </tr>
                <tr>
                   <td></td>
                   <td></td>
                   <td>Bedlining</td>
                   <td><input type="text" class="form-control" name="qty_bedlining" id="qty_bedlining" value = "0" style="width: 40%" onkeyup="sum_bedlining()"></td>
                   <td><input type="text" class="form-control" name="amt_bedlining" id="amt_bedlining" value = "0" style="width: 40%" onkeyup="sum_bedlining()"></td>
                   <td><input type="text" name="total_bedlining" id="total_bedlining" class="form-control"  value = "0" style="width: 40%" readonly></td>
               </tr>
               <tr>
                    <td></td>
                    <td></td>
                    <td>Pillow case</td>
                    <td><input type="text" class="form-control" name="qty_pillow_case" id="qty_pillow_case" value = "0" style="width: 40%" onkeyup="sum_pillow_case()"></td>
                    <td><input type="text" class="form-control" name="amt_pillow_case" id="amt_pillow_case" value = "0" style="width: 40%" onkeyup="sum_pillow_case()"></td>
                    <td><input type="text" name="total_pillow_case" id="total_pillow_case" class="form-control"  value = "0" style="width: 40%" readonly></td>
                </tr>
                <tr>
                   <td></td>
                   <td></td>
                   <td>Pillow</td>
                   <td><input type="text" class="form-control" name="qty_pillow" id="qty_pillow" value = "0" style="width: 40%" onkeyup="sum_pillow()"></td>
                   <td><input type="text" class="form-control" name="amt_pillow" id="amt_pillow" value = "0" style="width: 40%" onkeyup="sum_pillow()"></td>
                   <td><input type="text" class="form-control" name="total_pillow" id="total_pillow" value = "0" style="width: 40%" readonly></td>
               </tr>
               <tr>
                    <td></td>
                    <td></td>
                    <td>Rug</td>
                    <td><input type="text" class="form-control" name="qty_rug" id="qty_rug" value = "0" style="width: 40%" onkeyup="sum_rug()"></td>
                    <td><input type="text" class="form-control" name="amt_rug" id="amt_rug" value = "0" style="width: 40%" onkeyup="sum_rug()"></td>
                    <td><input type="text" name="total_rug" id="total_rug" class="form-control"  value = "0" style="width: 40%" readonly></td>
               </tr>
               <tr>
                    <td></td>
                    <td></td>
                    <td>Curtain/Blind</td>
                    <td><input type="text" class="form-control" name="qty_curtain" id="qty_curtain" value = "0" style="width: 40%" onkeyup="sum_curtain()"></td>
                    <td><input type="text" class="form-control" name="amt_curtain" id="amt_curtain" value = "0" style="width: 40%" onkeyup="sum_curtain()"></td>
                    <td><input type="text" class="form-control" name="total_curtain" id="total_curtain" value = "0" style="width: 40%" readonly></td>
               </tr>
               <tr>
                    <td></td>
                    <td></td>
                    <td>Towel</td>
                    <td><input type="text" class="form-control" name="qty_towel" id="qty_towel" value = "0" style="width: 40%" onkeyup="sum_towel()"></td>
                    <td><input type="text" class="form-control" name="amt_towel" id="amt_towel" value = "0" style="width: 40%" onkeyup="sum_towel()"></td>
                    <td><input type="text" class="form-control" name="total_towel" id="total_towel" value = "0" style="width: 40%" readonly></td>
                </tr>
                <tr>
                   <td>2. </td>
                   <td>GENERAL CLEANING</td>
                   <td></td>
                   <td></td>
                   <td><input type="text" class="form-control" name="amt_gc" id="amt_gc" value = "0" style="width: 40%" onkeyup="sum_gc()"></td>
                   <td><input type="text" class="form-control" name="total_gc" id="total_gc" value = "0"  style="width: 40%" readonly></td>
                </tr>
                <tr>
                   <td></td>
                   <td><b>GRAND TOTAL</b></td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td id="move_out_charges_grand_total" name="move_out_charges_grand_total"><b>0.00</b></td>
                </tr> 
            </table>
            @if (auth()->user()->privilege === 'leasingOfficer')
            <button onclick="return confirm('Are you sure you want to perform this operation? ');">MOVE OUT</button>            
            @endif
        @endif
        </form>
    </div>    
</div>
<br>
@endsection
<script type="text/javascript">

    function sum_comforter(){
        var qty_comforter = document.getElementById('qty_comforter').value;
        var amt_comforter = document.getElementById('amt_comforter').value;

        if(!isNaN(qty_comforter) && !isNaN(amt_comforter)){
            document.getElementById('total_comforter').value = (parseInt(qty_comforter) * parseInt(amt_comforter)).toFixed(2);
        }
    }
    function sum_bedlining(){
        var qty_bedlining = document.getElementById('qty_bedlining').value;
        var amt_bedlining = document.getElementById('amt_bedlining').value;
        if(!isNaN(qty_bedlining) && !isNaN(amt_bedlining)){
            document.getElementById('total_bedlining').value = (parseInt(qty_bedlining) * parseInt(amt_bedlining)).toFixed(2);;
        }
    }

    function sum_pillow_case(){
        var qty_pillow_case = document.getElementById('qty_pillow_case').value;
        var amt_pillow_case = document.getElementById('amt_pillow_case').value;
        if(!isNaN(qty_pillow_case) && !isNaN(amt_pillow_case)){
            document.getElementById('total_pillow_case').value =  (parseInt(qty_pillow_case) * parseInt(amt_pillow_case)).toFixed(2);
        }
    }
    
    function sum_pillow(){
        var qty_pillow = document.getElementById('qty_pillow').value;
        var amt_pillow = document.getElementById('amt_pillow').value;
        if(!isNaN(qty_pillow) && !isNaN(amt_pillow)){
            document.getElementById('total_pillow').value =  (parseInt(qty_pillow) * parseInt(amt_pillow)).toFixed(2);
        }
    }
 
    function sum_rug(){
        var qty_rug = document.getElementById('qty_rug').value;
        var amt_rug = document.getElementById('amt_rug').value;
        if(!isNaN(qty_rug) && !isNaN(amt_rug)){
            document.getElementById('total_rug').value =  (parseInt(qty_rug) * parseInt(amt_rug)).toFixed(2);
        }
    }
    
     function sum_curtain(){    
        var qty_curtain = document.getElementById('qty_curtain').value;
        var amt_curtain = document.getElementById('amt_curtain').value;
        if(!isNaN(qty_curtain) && !isNaN(amt_curtain)){
            document.getElementById('total_curtain').value =  (parseInt(qty_curtain) * parseInt(amt_curtain)).toFixed(2);
        }
    }
    
    function sum_towel(){
        var qty_towel = document.getElementById('qty_towel').value;
        var amt_towel = document.getElementById('amt_towel').value;
        if(!isNaN(qty_towel) && !isNaN(amt_towel)){
            document.getElementById('total_towel').value =  (parseInt(qty_towel) * parseInt(amt_towel)).toFixed(2);
        }
    }

    function sum_gc(){
        var qty_comforter = document.getElementById('qty_comforter').value;
        var amt_comforter = document.getElementById('amt_comforter').value;

        var qty_bedlining = document.getElementById('qty_bedlining').value;
        var amt_bedlining = document.getElementById('amt_bedlining').value;

        var qty_pillow_case = document.getElementById('qty_pillow_case').value;
        var amt_pillow_case = document.getElementById('amt_pillow_case').value;

        var qty_pillow = document.getElementById('qty_pillow').value;
        var amt_pillow = document.getElementById('amt_pillow').value;

        var qty_rug = document.getElementById('qty_rug').value;
        var amt_rug = document.getElementById('amt_rug').value;

        var qty_curtain = document.getElementById('qty_curtain').value;
        var amt_curtain = document.getElementById('amt_curtain').value;

        var qty_towel = document.getElementById('qty_towel').value;
        var amt_towel = document.getElementById('amt_towel').value;

        var amt_gc = document.getElementById('amt_gc').value;

        //comforter
        if(isNaN(qty_comforter)){
            qty_comforter = 1;
        }
        if(isNaN(amt_comforter)){
            amt_comforter = 1;
        }
        
        //bedlining
        if(isNaN(qty_bedlining)){
            qty_bedlining = 1;
        }
        if(isNaN(amt_bedlining)){
            amt_bedlining = 1;
        }
      
        //pillow case
        if(isNaN(qty_pillow_case)){
            qty_pillow_case = 1;
        }
        if(isNaN(amt_pillow_case)){
            amt_pillow_case = 1;
        }

        //pillow
        if(isNaN(qty_pillow)){
            qty_pillow = 1;
        }
        if(isNaN(amt_pillow)){
            amt_pillow = 1;
        }

        //rug
        if(isNaN(qty_rug)){
            qty_rug = 1;
        }
        if(isNaN(amt_rug)){
            amt_rug = 1;
        }

        //curtain
        if(isNaN(qty_curtain)){
            qty_curtain = 1;
        }
        if(isNaN(amt_curtain)){
            amt_curtain = 1;
        }

        //towel
        if(isNaN(qty_towel)){
            qty_towel = 1;
        }
        if(isNaN(amt_towel)){
            amt_towel = 1;
        }

        //general cleaning
        if(isNaN(amt_gc)){
            amt_gc = 1;
        }
        else{
            document.getElementById('total_gc').value = parseInt(amt_gc).toFixed(2);
            document.getElementById('move_out_charges_grand_total').innerHTML = 
            (
                parseInt(qty_comforter) * parseInt(amt_comforter)+
                parseInt(qty_bedlining) * parseInt(amt_bedlining)+
                parseInt(qty_pillow_case) * parseInt(amt_pillow_case)+
                parseInt(qty_pillow) * parseInt(amt_pillow) +
                parseInt(qty_rug) * parseInt(amt_rug) +
                parseInt(qty_curtain) * parseInt(amt_curtain) +
                parseInt(qty_towel) * parseInt(amt_towel) +
                parseInt(amt_gc)
            ).toFixed(2);
        }
    }
</script>

