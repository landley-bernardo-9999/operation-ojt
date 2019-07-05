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
 
    <div class="row">
       <div class="col-md-12">
            <table class="table">
                <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Unit</th>
                        {{-- <th>Mgmt Fee</th>
                        <th>Condo Dues</th>
                        <th>Others</th> --}}
                        <th>Remittance</th>
                        <th></th>
                        <?php $row_no = 1; ?>    
                    </tr>   
                    @foreach ($remittance as $remittance)
                    <tr>
                        <th> {{ $row_no++ }} </th>
                        <td> {{Carbon\Carbon::parse(  $remittance->billing_date )->formatLocalized('%b %d %Y')}} </td>
                        <td> {{ $remittance->building }} {{ $remittance->room_no }} </td>
                        <td> {{ $remittance->amt }} </td>
                        <td>
                            <a href="/payments/{{ $remittance->payment_id }}" class="btn-default">
                               SAVE
                            </a>
                        </td>
                        {{-- <td><input type="text" class="" style="width:50%" value="" name="mgmt_fee"></td>
                        <td><input type="text" class="" style="width:50%" value="" name="condo_dues"></td>
                        <td><input type="text" class="" style="width:50%" value="" name="others"></td> --}}
                        
                        {{-- @if($payment->term === 'short_term')
                        @if($payment->building === 'harvard')
                        <th>{{  $payment->short_term_rent - (($payment->size * 58.61) + ($payment->short_term_rent * 0.2))  }} </th>
                        @elseif($payment->building === 'princeton')
                        <th>{{  $payment->short_term_rent - (($payment->size * 58.61) + (1700))  }} </th> 
                        @elseif($payment->building === 'wharton')
                        <th>{{  $payment->short_term_rent - (($payment->size * 58.61) + ($payment->short_term_rent * 0.2))  }} </th> 
                        @endif
                        @elseif($payment->term === 'long_term')
                        @if($payment->building === 'harvard')
                        <th>{{  $payment->long_term_rent - (($payment->size * 58.61) + (780))  }} </th>
                        @elseif($payment->building === 'princeton')
                        <th>{{  $payment->long_term_rent - (($payment->size * 58.61) + (1200))  }} </th> 
                        @elseif($payment->building === 'wharton')
                        <th>{{  $payment->long_term_rent - (($payment->size * 58.61) + (1500))  }} </th> 
                        @endif
                        @endif --}}
                    
                        {{-- <td><a href="payments/{{$payment->payment_id}}/">MORE INFO</a></td> --}}
                    </tr>
                    @endforeach
            </table>
       </div>
    </div>


</div>
@endsection
