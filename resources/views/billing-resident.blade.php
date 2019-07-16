@extends('layouts.app')
@section('title', session('billing_resident_name'))
@section('content')
<div class="container">
    <div class="row">
        <table class="table">
            <tr>
                 <td>
                Resident Name: <b>{{session('billing_resident_name')}}</b>
                </td>
               
                <td>
                    Unpaid Amount: <b>{{ number_format($balance,2) }}</b>
                </td>
            </tr>
            <tr>
                 <td>
                    Unit:   
                    @foreach ($unit as $unit)
                        <b>{{ $unit->building }} {{ $unit->room_no }}, </b>
                    @endforeach
                </td>
            </tr>
        </div>
    </div>
    
    <div class="row">
        <table class="table">
               <p><h4><b> Statement of Accounts</b></<h4`></p>
           <?php $row_no_payments = 1; ?>
           <tr>
               <th>#</th>
               <th>Billing Date</th>
               <th>Unit No</th>
               <th>Description</th>
               <th>Amount</th>
               <th>Status</th>
               <th></th>
           </tr>
           @foreach ($payment as $payment)
           <tr id="payments{{ $payment->payment_id }}">
                <th>{{ $row_no_payments++ }}</th>
                <td> {{Carbon\Carbon::parse(  $payment->billing_date )->formatLocalized('%b %d %Y')}}</td>
                <td>{{ $payment->building }} {{ $payment->room_no }}</td>
                <td>{{ $payment->desc }}</td>
                <td>{{ number_format($payment->amt, 2) }}</td>
                <td>{{ $payment->payment_status }}</td>
                <td><a class="edit-bill" data-toggle="modal" data-id="{{ $payment->payment_id }}" data-target="#exampleModal">
                         OPEN
                    </a>
                </td>
           </tr>
           @endforeach
          
        </table>
    </div>    
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit BIlling</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection
