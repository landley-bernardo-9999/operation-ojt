@extends('layouts.app')
@section('title',  'Remittance')


@section('content')
<div class="container">
   
    <div class="row">
         <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class=""href="/payments" oncontextmenu="return false">Back</a>
            </li>
        </ul>
    </div>
 
@foreach ($remittance as $remittance)
<form class="" method="POST" action="/payments/{{ $remittance->payment_id }}">
    @method('PATCH')
    {{ csrf_field() }}
    <div class="row">
     <p class="float-left">Date: {{Carbon\Carbon::parse(  $remittance->billing_date )->formatLocalized('%b %d %Y')}}</p>
     <p class="float-right">Unit No: {{ $remittance->building }} {{ $remittance->room_no }}</p>
     <div class="container">
        <table class="table">
            <tr>
                <th>Management Fee</th>
                <th>Condo Dues</th>
                <th>Others</th>
                <th></th>
                <th>Remmittance</th>
            </tr>
            <tr>
                <td><input type="number" class="" style="width:50%" value="{{ $remittance->mgmt_fee }}" name="mgmt_fee" id="mgmt_fee" readonly></td>
                <td><input type="number" class="" style="width:50%" value="{{ $remittance->condo_dues }}" name="condo_dues"  id="condo_dues" readonly></td>
                <td><input type="text" class="" style="width:50%" value="{{ $remittance->others }}" name="others" id="others" onkeyup="auto_compute_remittance()"></td> 
                <td> <input type="hidden" class="" style="width:50%" value="{{ $remittance->remittance_amt }}" name="dummy_remittance_amt" id="dummy_remittance_amt"></td>
                <th><input type="number" class="" style="width:50%" value="{{ $remittance->remittance_amt }}" name="remittance_amt" id="remittance_amt" readonly> </th>
            </tr>
        </table>
     </div>
     @if (auth()->user()->privilege === 'billingAndCollection')
     <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default">SAVE</button>     
     @endif
    
    </div>
</form>
@endforeach

</div>
@endsection
<script>
     function auto_compute_remittance(){    
        var mgmt_fee = document.getElementById('mgmt_fee').value;
        var condo_dues = document.getElementById('condo_dues').value;
        var others = document.getElementById('others').value;
        var dummy_remittance_amt = document.getElementById('dummy_remittance_amt').value;
        
        document.getElementById('remittance_amt').value = parseFloat((dummy_remittance_amt)  - parseFloat(others));
     }
</script>
