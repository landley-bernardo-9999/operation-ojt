@extends('layouts.app')
@section('title', session('resident_name'))
@section('content')
<div class="container">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="/residents/{{ session('resident_id') }}" oncontextmenu="return false"><i class="far fa-arrow-alt-circle-left"></i>&nbspBack</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transactions/{{ $transaction->trans_id }}/edit" oncontextmenu="return false"><i class="fas fa-sign-out-alt"></i>&nbspMove Out</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <table class="table">
        <tr>
            <h3>Leasing Agreement</h3>
        </tr>
        <tr>
            <td>Transaction Date:</td>
            <td> {{Carbon\Carbon::parse(  $transaction->trans_date )->formatLocalized('%b %d %Y')}} </<td>
        </tr>
        @foreach ($resident as $resident)
        <tr>
            <td>Resident Name:</td>
            <td>{{ $resident->first_name }} {{ $resident->last_name }}</td>
        </tr>
        <tr>
            <td>Unit No:</td>
            <td>{{ $resident->building }} {{ $resident->room_no }}</td>
        </tr>
        @if (auth()->user()->privilege === 'leasingOfficer')
        <tr>
            <td>Owner Name:</td>
            <td>{{ $resident->owner_first_name }} {{ $resident->owner_last_name }}</td>
        </tr>    
        @endif
        <tr>
            <td>Status of the contract:</td>
            <td>{{ $transaction->trans_status }}</td>
        </tr>
        <tr>
            <td>Contract Period:</td>
            <td>{{Carbon\Carbon::parse(  $transaction->move_in_date )->formatLocalized('%b %d %Y')}} - {{Carbon\Carbon::parse(  $transaction->move_out_date )->formatLocalized('%b %d %Y')}} ({{ $transaction->term }})</td>
        </tr>
        @endforeach
        </table>
        <form method="POST" action="/transactions/{{ $resident->trans_id }}">
            @method('PATCH')
        {{ csrf_field() }}
        <table class="table">
            <tr>
                <h3>Utility Readings</h3>
            </tr>
            <tr>
                <th><label for="">Water</label></th>
                <th></th>
                <th><label for="">Electric</label></th>
                <th></th>
            </tr>
            @if($transaction->trans_status == 'active' || $transaction->trans_resident_id != session('resident_id'))
            <tr>
                <td>Initial</td>
                <td><input type="text" class="form-control" style="width:30%" name="initial_water_reading" value="{{ $transaction->initial_water_reading }}"></td>
                <td>Initial</td>
                <td><input type="text" class="form-control" style="width:30%" name="initial_electric_reading" value="{{ $transaction->initial_electric_reading }}"></td>
                @if(auth()->user()->privilege === 'leasingOfficer')
                <th><button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-check-circle"></i>&nbspSUBMIT</button></th>
                @endif
            </tr>
            @else
             <tr>
                <td>Initial</td>
                <td>{{ $transaction->initial_water_reading }}</td>
                <td>Initial</td>
                <td>{{ $transaction->initial_electric_reading }}</td>
            </tr>
            @endif

        </table>
        </form>
    </div>    
</div>
@endsection
