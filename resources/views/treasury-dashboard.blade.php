@extends('layouts.app')
@section('title',  'Dashboard')
@section('content')
<div class="container">
    <div class="row">
        <h3>Daily Collection Report</h3>
    </div>
    <div class="row">
        <form class="" action="/search/payments" method="GET">
           <div class="col-md-11">
                <input type="date" class="form-control" style="width:20%" name="payment_date" value="{{ Request::query('payment_date') }}">
            
           </div>
           <div class="col-md-1">
                <button class="btn btn-default" type="hidden">Search</button>
           </div>
        </form>
    </div>
    <div class="row">
        <table border='2' style="width:100%;padding:10%;">
            <br>
            @if($collection->count() > 0)
            <p class="text-center"><b>{{ $collection->count() }}</b> collections found.</p>
            <tr>
                <th>#</th>
                <th >UNIT NO</th>
                <th>DATE PAID</th>
                <th>OR NO</th>
                <th>AR NO</th>
                <th>TOTAL</th>
                <th>PARTICULARS</th>
                <th>TENANT</th>
                <th>UNIT OWNER</th>
                <th>FORM OF PAYMENT</th>
                <th>AMT PAID</th>
            </tr>
            <?php  $row_no = 1; ?>
            @foreach ($collection as $row)
            <tr>
                <th> {{ $row_no++ }} </th>
                <td> {{ $row->building }} {{ $row->room_no }}</td>
                <td> {{ Carbon\Carbon::parse(  $row->payment_date )->formatLocalized('%b %d %Y')}} </td>
                <td> {{ $row->or_number }} </td>
                <td> {{ $row->ar_number }} </td>
                <td> {{ number_format($row->amt,2) }} </td>
                <td> {{ $row->desc }} </td>
                <td> {{ $row->first_name }} {{ $row->last_name }} </td>
                <td> {{ $row->owner_first_name }} {{ $row->owner_last_name }} </td>
                <td> {{ $row->form_of_payment }} {{ $row->bank_name }} {{ $row->check_no }} </td>
                <td> {{ number_format($row->amt_paid,2) }} </td>
            </tr>
            @endforeach
            <tr>
                <th></th>
                <th>GRANDTOTAL</th>
                <td></td>
                <td></th>
                <td></td>
                <th>{{ number_format($collection->sum('amt'),2) }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>{{ number_format($collection->sum('amt_paid'),2) }}</th>
            </tr>
            @else
            <p class="text-danger text-center">No collections found.</p>
          @endif
        </table>
    </div>
    <br>
    {{-- <div class="row">
         <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Average Collection/Day</h3>
                </div>
                <div class="panel-body">
                    <h1></h1>
                </div>
            </div>
        </div>
    <br>
</div> --}}
@endsection
