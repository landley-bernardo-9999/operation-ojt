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
                    <th>TOTAL</th>
                </tr>
                <tr>
                    <td>Harvard</td>
                    <td>{{ $occupied_rooms_harvard }}</td>
                    <td>{{ $vacant_rooms_harvard }}</td>
                    <td>{{ $reserved_rooms_harvard }}</td>
                    <td>{{ $rectification_rooms_harvard }}</td> 
                    <th>{{ $occupied_rooms_harvard + $vacant_rooms_harvard + $reserved_rooms_harvard + $rectification_rooms_harvard }}</th>
                </tr>
                 <tr>
                    <td>Princeton</td>
                    <td>{{ $occupied_rooms_princeton }}</td>
                    <td>{{ $vacant_rooms_princeton }}</td>
                    <td>{{ $reserved_rooms_princeton }}</td>
                    <td>{{ $rectification_rooms_princeton }}</td>
                    <th>{{ $occupied_rooms_princeton + $vacant_rooms_princeton + $reserved_rooms_princeton + $rectification_rooms_princeton }}</th>
                </tr>
                 <tr>
                    <td>Wharton</td>
                    <td>{{ $occupied_rooms_wharton }}</td>
                    <td>{{ $vacant_rooms_wharton }}</td>
                    <td>{{ $reserved_rooms_wharton }}</td>
                    <td>{{ $rectification_rooms_wharton }}</td>
                    <th>{{ $occupied_rooms_wharton + $vacant_rooms_wharton + $reserved_rooms_wharton + $rectification_rooms_wharton }}</th>
                </tr>
                <tr>
                    <td>Manors</td>
                    <td>{{ $occupied_rooms_manors }}</td>
                    <td>{{ $vacant_rooms_manors }}</td>
                    <td>{{ $reserved_rooms_manors }}</td>
                    <td>{{ $rectification_rooms_manors }}</td>
                    <th>{{ $occupied_rooms_manors + $vacant_rooms_manors + $reserved_rooms_manors + $rectification_rooms_manors }}</th>
                </tr>
                <tr>
                    <td>Loft</td>
                    <td>{{ $occupied_rooms_loft }}</td>
                    <td>{{ $vacant_rooms_loft }}</td>
                    <td>{{ $reserved_rooms_loft }}</td>
                    <td>{{ $rectification_rooms_loft }}</td>
                    <th>{{ $occupied_rooms_loft +  $vacant_rooms_loft + $reserved_rooms_loft + $rectification_rooms_loft }}</th>
                </tr>
                <tr>
                    <td>Colorado</td>
                    <td>{{ $occupied_rooms_colorado }}</td>
                    <td>{{ $vacant_rooms_colorado }}</td>
                    <td>{{ $reserved_rooms_colorado }}</td>
                    <td>{{ $rectification_rooms_colorado }}</td>
                    <th>{{ $occupied_rooms_colorado + $vacant_rooms_colorado + $reserved_rooms_colorado + $rectification_rooms_colorado }}</th>
                </tr>
                <tr>
                    <td>Arkansas</td>
                    <td>{{ $occupied_rooms_arkansas }}</td>
                    <td>{{ $vacant_rooms_arkansas }}</td>
                    <td>{{ $reserved_rooms_arkansas }}</td>
                    <td>{{ $rectification_rooms_arkansas }}</td>
                    <th>{{ $occupied_rooms_arkansas + $vacant_rooms_arkansas + $reserved_rooms_arkansas + $rectification_rooms_arkansas }}</th>
                </tr>
                <tr>
                    <th>TOTAL</th>
                    <th>{{ $occupied_rooms_harvard + $occupied_rooms_princeton + $occupied_rooms_wharton + $occupied_rooms_colorado + $occupied_rooms_manors + $occupied_rooms_loft + $occupied_rooms_colorado + $occupied_rooms_arkansas }}</th>
                    <th>{{ $vacant_rooms_harvard + $vacant_rooms_princeton + $vacant_rooms_wharton + $vacant_rooms_colorado + $vacant_rooms_manors + $vacant_rooms_loft + $vacant_rooms_colorado + $vacant_rooms_arkansas }}</th>
                    <th>{{ $reserved_rooms_harvard + $reserved_rooms_princeton + $reserved_rooms_wharton + $reserved_rooms_colorado + $reserved_rooms_manors + $reserved_rooms_loft + $reserved_rooms_colorado + $reserved_rooms_arkansas }}</th>
                    <th>{{ $rectification_rooms_harvard + $rectification_rooms_princeton + $rectification_rooms_wharton + $rectification_rooms_colorado + $rectification_rooms_manors + $rectification_rooms_loft + $rectification_rooms_colorado + $rectification_rooms_arkansas }}</th>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <h3>Reserved Units</h3>
        @if ($reserved_rooms->count() < 0)
        <p class="text-danger">No reserved units.</p>
        @endif
        <ul>
            @foreach ($reserved_rooms as $room)
                <li><a href="/rooms/{{ $room->room_id }}">{{ $room->building }} {{ $room->room_no }}</a></li>
            @endforeach
        </ul>
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
                <h1>{{ number_format($occupancy_nc,2) }}%</h1>
            </div>
        </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="panel">
            <div class="panel-header">
                <h3>The Courtyards</h3>
            </div>
            <div class="panel-body">
                <h1>{{ number_format($occupancy_cy, 2) }}%</h1>
            </div>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Last 10 move in</h3>
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Resident</th>
                    <th>Unit</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                <?php $row_no_move_in = 1; ?>
                @foreach ($move_in as $move_in)
                <tr>
                    <td>{{ $row_no_move_in++ }}.</td>
                    <td>{{ $move_in->first_name}} {{ $move_in->last_name }}</td>
                    <td>{{ $move_in->room_no}} </td>
                    <td>{{Carbon\Carbon::parse(  $move_in->move_in_date )->formatLocalized('%b %d %Y')}}</td>
                    <td><a href="rooms/{{ $move_in->room_id }}" oncontextmenu="return false">MORE INFO</a></td>
                </tr>
                @endforeach
            </table>
            
        </div>
        <div class="col-md-6">
            <h3>Last 10 move out</h3>
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Resident</th>
                    <th>Unit</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                <?php $row_no_move_out = 1; ?>
                @foreach ($move_out as $move_out)
                <tr>
                    <td>{{ $row_no_move_out++ }}.</td>
                    <td>{{ $move_out->first_name}} {{ $move_out->last_name }}</td>
                    <td>{{ $move_out->room_no}} </td>
                    <td>{{Carbon\Carbon::parse(  $move_out->actual_move_out_date )->formatLocalized('%b %d %Y')}}</td>
                    <td><a href="rooms/{{ $move_out->room_id }}" oncontextmenu="return false">MORE INFO</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

