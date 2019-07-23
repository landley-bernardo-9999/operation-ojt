@extends('layouts.app')
@if(auth()->user()->privilege === 'leasingOfficer')
@section('title',  session('billing_owner_name'))
@else
@section('title',  'MORE INFO')
@endif
@section('content')
<div class="container">
@foreach ($remittance as $remittance)
<form class="" method="POST" action="/payments/{{ $remittance->payment_id }}">
    @method('PATCH')
    {{ csrf_field() }}
    <div class="row">
        <table class="table">
            <tr>
                 <td>
                    Date: <b>{{Carbon\Carbon::parse(  $remittance->billing_date )->formatLocalized('%b %d %Y')}}</b>
                </td>
            </tr>
            <tr>
                 <td>
                    Unit No:  <b>{{ $remittance->building }} {{ $remittance->room_no }}</b>
                </td>
            </tr>
        </table>
        
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
                <td><input type="number" class="form-control" style="width:50%" value="{{ $remittance->mgmt_fee }}" name="mgmt_fee" id="mgmt_fee" readonly></td>
                <td><input type="number" class="form-control" style="width:50%" value="{{ $remittance->condo_dues }}" name="condo_dues"  id="condo_dues" readonly></td>
                <td><input type="text" class="form-control" style="width:50%" value="{{ $remittance->others }}" name="others" id="others" onkeyup="auto_compute_remittance()" required></td> 
                <td> <input type="hidden" class="form-control" style="width:50%" value="{{ $remittance->remittance_amt }}" name="dummy_remittance_amt" id="dummy_remittance_amt"></td>
                <th><input type="number" class="form-control" style="width:50%" value="{{ number_format($remittance->remittance_amt,2) }}" name="remittance_amt" id="remittance_amt" readonly> </th>
            </tr>
        </table>
     </div>
     @if (auth()->user()->privilege === 'billingAndCollection')
     <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-check-circle"></i>&nbspSUBMIT</button>     
     @endif
    
    </div>
</form>
@endforeach
</div>
<script>
    window.onload = auto_compute_remittance;
    
    function auto_compute_remittance(){    
        var mgmt_fee = document.getElementById('mgmt_fee').value;
        var condo_dues = document.getElementById('condo_dues').value;
        var others = document.getElementById('others').value;
        var dummy_remittance_amt = document.getElementById('dummy_remittance_amt').value;
        
        document.getElementById('remittance_amt').value = parseFloat((dummy_remittance_amt)  - parseFloat(others));

        if( others === ''){
            document.getElementById('remittance_amt').value = dummy_remittance_amt;
        }
     }
</script>
@endsection

