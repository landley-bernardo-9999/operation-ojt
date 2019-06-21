@extends('layouts.app')
@section('title', session('resident_name'))
@section('content')
<div class="container">
    <form method="POST" action="/transactions/{{ $transaction->trans_id }}">
        @method('PATCH')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-2">
            <a class="" href="/transactions/{{ $transaction->trans_id }}">BACK</a>
        </div>
    </div>
    <div class="row">
         <tr>
            <h3>Resident Move-out Form</h3>
        </tr>
        <table class="table table-borderless">
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
            <td>Contract Status</td>
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
            <td> <input type="date" class="form-control" style="width:50%" name="actual_move_out_date" value="" required></<td>
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

        <table class="table">
           <tr>
               <h3>Payments</h3>
           </tr>
           <?php $row_no_payments = 1; ?>
           <tr>
               <th>No.</th>
               <th>Date</th>
               <th>Description</th>
               <th>Amount</th>
               <th>Status</th>
           </tr>
           @foreach ($payment as $payment)
           <tr>
                <td>{{ $row_no_payments++ }}.</td>
                <td> {{Carbon\Carbon::parse(  $payment->trans_date )->formatLocalized('%b %d %Y')}}</td>
                <td>{{ $payment->desc }}</td>
                <td>{{ number_format($payment->amt, 2) }}</td>
                <td>{{ $payment->payment_status }}</td>
           </tr>
           @endforeach
          
        </table>

        @if($transaction->trans_status == 'inactive')

        @else
            <button onclick="return confirm('Are you sure you want to perform this operation? ');">MOVE OUT</button>
        @endif
        </form>
    </div>    
</div>
@endsection
