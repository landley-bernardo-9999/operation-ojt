@extends('layouts.app')
@section('title',  session('billing_owner_name'))
@section('content')
<div class="container">
   <div class="row">
        <table class="table">
            <tr>
                 <td>
                Unit Owner Name: <b>{{session('billing_owner_name')}}</b>
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
        </table>
        </div>
    <div class="row">
       <div class="col-md-12">
            <table class="table">
                 @if($remittances->count() > 0)
                <p>{{ $remittances->count() }} remmittances found.</p>
                <tr>
                    <th>#</th>
                    <th>Billing Date</th>
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
                    @else
                    <p class="text-danger">No remittances found.</p>
                    @endif
            </table>
       </div>
    </div>
</div>
@endsection
