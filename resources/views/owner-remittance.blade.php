@extends('layouts.app')
@section('title',  auth()->user()->name)
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
                        <th>Remittance</th>
                        <th></th>
                        <?php $row_no = 1; ?>    
                    </tr>   
                    @foreach ($remittances as $remittance)
                    <tr>
                        <th> {{ $row_no++ }} </th>
                        <td> {{Carbon\Carbon::parse(  $remittance->billing_date )->formatLocalized('%b %d %Y')}} </td>
                        <td> {{ $remittance->building }} {{ $remittance->room_no }} </td>
                        <td> {{ $remittance->remittance_amt }} </td>
                        <td>
                            <a href="/payments/{{ $remittance->payment_id }}">
                                MORE INFO
                            </a>
                        </td>
                       
                    </tr>
                    @endforeach
            </table>
       </div>
    </div>
</div>
@endsection
