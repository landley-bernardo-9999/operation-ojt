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
                @if($transaction->updated_at != null)
                    <a class="nav-link" href="/transactions/{{ $transaction->trans_id }}/edit" oncontextmenu="return false"><i class="fas fa-sign-out-alt"></i>&nbspMove out resident.</a>
            </li>
        </ul>
                @elseif($transaction->created_at ==null)
                    <form action="/transactions/{{ $transaction->trans_id }}" method="POST">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <p>
                             <input type="hidden" name="action" value="request_for_move_out">
                            <button class="btn-default" onclick="return confirm('Are you sure you want to perform this operation? ');"><i class="fas fa-sign-out-alt"></i>&nbspRequest for move out.</button>   
                        </p> 
                    </form>
                @else
                        <a title="Waiting for the leasing manager's approval..." class="nav-link text-danger" href="#" oncontextmenu="return false"><i class="fas fa-sign-out-alt"></i>&nbspRequest has already been sent.</a>
                @endif
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
            
            <tr>
                <td>Initial</td>
                <td>
                    <input type="text" class="form-control" style="width:30%" name="initial_water_reading" value="{{ $transaction->initial_water_reading }}">
                    
                    <input type="hidden" name="action" value="adding_utilities">
                </td>
                <td>Initial</td>
                <td><input type="text" class="form-control" style="width:30%" name="initial_electric_reading" value="{{ $transaction->initial_electric_reading }}"></td>
                <th><button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-check-circle"></i>&nbspSUBMIT</button></th>
        </table>
        </form>
    </div>    
</div>
@endsection
