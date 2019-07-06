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
                        
                        <th>Date</th>
                        <th>Unit</th>
                        <th>Mgmt Fee</th>
                        <th>Condo Dues</th>
                        <th>Others</th> 
                        <th>Remittance</th>
                    
                         
                    </tr>   
                    @foreach ($remittance as $remittance)
                    
                    <form class="" method="POST" action="/payments/{{ $remittance->payment_id }}">
                        @method('PATCH')
                        {{ csrf_field() }}
                   
                    <tr>
                        
                        <td>{{Carbon\Carbon::parse(  $remittance->billing_date )->formatLocalized('%b %d %Y')}}</td>
                        <td>    {{ $remittance->building }} {{ $remittance->room_no }} </td>
                        
                        <td><input type="text" class="" style="width:50%" value="{{ $remittance->mgmt_fee }}" name="mgmt_fee"></td>
                        <td><input type="text" class="" style="width:50%" value="{{ $remittance->condo_dues }}" name="condo_dues"></td>
                        <td><input type="text" class="" style="width:50%" value="{{ $remittance->others }}" name="others"></td> 
                        <td> {{ $remittance->remittance_amt }} </td>
                   
                   
                    </tr>
                    @endforeach
            </table>
            <button type="submit" class="btn-default">SAVE</button>
        </form> 
       </div>
    </div>


</div>
@endsection
