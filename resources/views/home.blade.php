@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row">
        <h3>Dashboard</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <th></th>
                    <th>Occupied</th>
                    <th>Vacant</th>
                    <th>Reserved</th>
                    <th>Rectification</th>
                </tr>
                <tr>
                    <td>Harvard</td>
                    <td>{{ $occupied_rooms_harvard }}</td>
                    <td>{{ $vacant_rooms_harvard }}</td>
                    <td>{{ $reserved_rooms_harvard }}</td>
                    <td>{{ $rectification_rooms_harvard }}</td>
                </tr>
                 <tr>
                    <td>Princeton</td>
                    <td>{{ $occupied_rooms_princeton }}</td>
                    <td>{{ $vacant_rooms_princeton }}</td>
                    <td>{{ $reserved_rooms_princeton }}</td>
                    <td>{{ $rectification_rooms_princeton }}</td>
                </tr>
                 <tr>
                    <td>Wharton</td>
                    <td>{{ $occupied_rooms_wharton }}</td>
                    <td>{{ $vacant_rooms_wharton }}</td>
                    <td>{{ $reserved_rooms_wharton }}</td>
                    <td>{{ $rectification_rooms_wharton }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <h3>Occupancy Rate</h3>
    </div>
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="panel">
            <div class="panel-header">
                <h3>North Cambridge</h3>
            </div>
            <div class="panel-body">
                <h1>{{ $occupancy_nc }}%</h1>
            </div>
        </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="panel">
            <div class="panel-header">
                <h3>The Courtyards</h3>
            </div>
            <div class="panel-body">
                <h1>{{ $occupancy_cy }}%</h1>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <h3>Stats</h3>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Rooms</h3>
                </div>
                <div class="panel-body">
                    <h1>{{ $rooms }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Residents</h3>
                </div>
                <div class="panel-body">
                    <h1>{{ $residents }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Owners</h3>
                </div>
                <div class="panel-body">
                    <h1>{{ $owners }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Last 10 move in</h3>
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Unit No</th>
                    <th>Move In </th>
                    <th></th>
                </tr>
                <?php $row_no_move_in = 1; ?>
                @foreach ($move_in as $move_in)
                <tr>
                    <td>{{ $row_no_move_in++ }}</td>
                    <td>{{ $move_in->first_name}} {{ $move_in->last_name }}</td>
                    <td>{{ $move_in->room_no}} </td>
                    <td>{{Carbon\Carbon::parse(  $move_in->move_in_date )->formatLocalized('%b %d %Y')}}</td>
                    <td><a href="rooms/{{ $move_in->room_id }}">MORE INFO</a></td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-6">
            <h3>Last 10 move out</h3>
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Unit No</th>
                    <th>Move In </th>
                    <th></th>
                </tr>
                <?php $row_no_move_out = 1; ?>
                @foreach ($move_out as $move_out)
                <tr>
                    <td>{{ $row_no_move_out++ }}</td>
                    <td>{{ $move_out->first_name}} {{ $move_out->last_name }}</td>
                    <td>{{ $move_out->room_no}} </td>
                    <td>{{Carbon\Carbon::parse(  $move_out->actual_move_out_date )->formatLocalized('%b %d %Y')}}</td>
                    <td><a href="rooms/{{ $move_out->room_id }}">MORE INFO</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
