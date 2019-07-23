@extends('layouts.app')
@if(auth()->user()->privilege === 'billingAndCollection')
    @section('title', session('billing_resident_name'))
@else
    @section('title', session('treasury_resident_name'))
@endif
@section('content')
<div class="container">
    @if(auth()->user()->privilege === 'billingAndCollection')
     <div class="row">
        <ul class="nav navbar-nav">
            <li class="">
                <!-- Button trigger modal -->
                <a data-toggle="modal" data-target="#exampleModal" href="#/" oncontextmenu="return false"><i class="fas fa-plus"></i>&nbspAdd billing</a>
            </li>
        </ul>
    </div>
    @endif
    <div class="row">
        <table class="table">
            <tr>
                 <td>
                Resident Name: <b>{{session('billing_resident_name')}}</b>
                </td>
               
                <td>
                    Total Balance: <b>{{ number_format($total_amt - $total_amt_paid,2)  }}</b>
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
            @if($payment->count() > 0)
            <p>{{ $payment->count() }} billings found.</p>
           <?php $row_no = 1; ?>
           <tr>
               <th>#</th>
               <th>Billing Date</th>
               <th>Unit No</th>
               <th>Description</th>
               <th>Amount</th>
               <th>Balance</th>
           </tr>
           @foreach ($payment as $row)
           <tr>
                <th>{{ $row_no++ }}</th>
                <td> {{Carbon\Carbon::parse(  $row->billing_date )->formatLocalized('%b %d %Y')}}</td>
                <td>{{ $row->building }} {{ $row->room_no }}</td>
                <td>{{ $row->desc }}</td>
                <td>{{ number_format($row->amt, 2) }}</td>
                <td>{{ number_format(($row->amt - $row->amt_paid), 2) }}</td>
                @if(auth()->user()->privilege === 'treasury')
                <td><a href="/payments/{{ $row->payment_id }}/edit">OPEN</a></td>
                @elseif(auth()->user()->privilege === 'billingAndCollection')
                <td>
                    <form method="POST" action="/payments/{{ $row->payment_id }}">
                        @method('delete')
                        {{ csrf_field() }}
                        <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-danger"><i class="fas fa-times"></i></button>
                    </form>
                </td>
                @endif
           </tr>
           @endforeach
           @else
          <p class="text-danger">No billings found.</p>
            @endif
        </table>
    </div>    
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><b>Billing Info</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" method="POST" action="/payments">
        {{ csrf_field() }}
      <div class="modal-body">
            <div class="form-group">
                <label for="billing_date">Billing Date</label>
                <input type="date" class="form-control" name="billing_date" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="trans_id">Unit No</label>
               <select name="trans_id" id="trans_id" class="form-control" required>
                   @foreach ($unit_selection as $row)
                   <option value="{{ $row->trans_id }}" selected>{{ $row->building }} {{ $row->room_no }}</option>
                   @endforeach
               </select>
            </div>
             <div class="form-group">
                <label for="desc">Description</label>
               <select name="desc" id="desc" class="form-control" required>
                   <option value="" selected>Select Description</option>
                    <option value="electric_bill">Electric Bill</option>
                    <option value="water_bill">Water Bill</option>
                   <option value="others">Others</option>
               </select>
            </div>
            <div class="form-group">
                <label for="amt">Amount</label>
                <input type="text" class="form-control" name="amt" required>
            </div>
      </div>
      <div class="modal-footer">
         <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-check-circle"></i>&nbspSUBMIT</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection
