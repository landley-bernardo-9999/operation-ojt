@extends('layouts.app')
@section('title', session('resident_name'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <a class="" href="/residents/{{ session('resident_id') }}">BACK</a>
        </div>
        <div class="col-md-2">
            <a class="float-right" href="/residents/create/">MOVE OUT</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-borderless">
        <tr>
            <h3>Contract</h3>
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
            <td>Owner Name:</td>
            <td>{{ $resident->owner_first_name }} {{ $resident->owner_last_name }}</td>
        </tr>
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
                <th><label for="">Electric</label></th>
            </tr>
            
            <tr>
                <td>Initial <input type="number" class="form-control" style="width:30%" name="initial_water_reading" value="{{ $transaction->initial_water_reading }}"> </td>
                <td>Initial <input type="number" class="form-control" style="width:30%" name="initial_electric_reading" value="{{ $transaction->initial_electric_reading }}"></td>
            </tr>
            <tr>
                <td>Final  <input type="number" class="form-control" style="width:30%" name="final_water_reading" value="{{ $transaction->final_water_reading }}"></td>
                <td>Final  <input type="number" class="form-control" style="width:30%" name="final_electric_reading" value="{{ $transaction->final_water_reading }}"></td>
            </tr>
            <tr>
                <th ><button type="submit">SAVE</button></th>
                <td></td>
            </tr>

        </table>
        </form>
    </div>    
</div>
@endsection
