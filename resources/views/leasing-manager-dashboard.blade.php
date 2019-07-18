@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row">
        <h3>Dashboard</h3>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Rooms Enrolled</h3>  
                </div>
                <div class="panel-body">
                    <h1>{{ $rooms }}</h1>
                    <br>
                    <div class="col-md-6">
                        <p>NC</p>
                        <h3>{{ $nc_rooms }}</h3>
                    </div>
                    <div class="col-md-6">
                        <p>CY</p>
                        <h3>{{ $cy_rooms }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Active Residents</h3>
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
                    <th>{{ $occupied_rooms_harvard + $occupied_rooms_princeton + $occupied_rooms_wharton + $occupied_rooms_colorado + $occupied_rooms_manors + $occupied_rooms_loft + $occupied_rooms_arkansas }}</th>
                    <th>{{ $vacant_rooms_harvard + $vacant_rooms_princeton + $vacant_rooms_wharton + $vacant_rooms_colorado + $vacant_rooms_manors + $vacant_rooms_loft + $vacant_rooms_arkansas }}</th>
                    <th>{{ $reserved_rooms_harvard + $reserved_rooms_princeton + $reserved_rooms_wharton + $reserved_rooms_colorado + $reserved_rooms_manors + $reserved_rooms_loft + $reserved_rooms_arkansas }}</th>
                    <th>{{ $rectification_rooms_harvard + $rectification_rooms_princeton + $rectification_rooms_wharton + $rectification_rooms_colorado + $rectification_rooms_manors + $rectification_rooms_loft +  $rectification_rooms_arkansas }}</th>
                    <th>{{ $rooms }}</th>
                </tr>
            </table>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
            <h3>Upcoming Moveouts</h3>
            <table class="table">
                @if($about_to_move_out->count() > 0)
                <p>{{ $about_to_move_out->count() }} upcoming moveouts.</p>
                <tr>
                    <th>#</th>
                    <th>Resident</th>
                    <th>Building</th>
                    <th>Unit</th>
                    <th>Move Out Date</th>
                    <th></th>
                </tr>
                <?php $row_no = 1; ?>
                @foreach ($about_to_move_out as $row)
                <tr>
                    <th>{{ $row_no++ }}</th>
                    <td>{{ $row->first_name}} {{ $row->last_name }}</td>
                    <td>{{ $row->building }}</td>
                    <td>{{ $row->room_no}} </td>
                    <td>{{Carbon\Carbon::parse(  $row->move_out_date )->formatLocalized('%b %d %Y')}}</td>
                    <td><a href="rooms/{{ $row->room_id }}" oncontextmenu="return false">MORE INFO</a></td>
                </tr>
                @endforeach
                @else
                <p class="text-danger">No upcoming moveouts yet.</p>
              @endif
            </table>
        </div>                
    </div>
        <h3>Newly Enrolled Units</h3>
    <div class="row">
        <div class="col-md-6">
                <h4>North Cambridge</h4>
            <table class="table">
                 @if($nc_units_enrolled->count() > 0)
                <p>{{ $nc_units_enrolled->count() }} newly enrolled units in North Cambridge.</p>
                <?php $row_no = 1; ?>
                @foreach ($nc_units_enrolled as $row)
                <tr>
                    <th>{{ $row_no++ }}</th>
                    <td>{{ $row->building }}</td>
                    <td>{{ $row->room_no}}</td>
                    <td>{{Carbon\Carbon::parse(  $row->enrollment_date )->formatLocalized('%b %d %Y')}}</td>
                    <td><a href="rooms/{{ $row->room_id }}" oncontextmenu="return false">MORE INFO</td>
                </tr>
                @endforeach
                @else
                <p class="text-danger">No newly enrolled units in North Cambridge..</p>
              @endif
            </table>
        </div> 

        <div class="col-md-6">
                <h4>Courtyards</h4>
            <table class="table">
                    @if($cy_units_enrolled->count() > 0)
                    <p>{{ $cy_units_enrolled->count() }} newly enrolled units in Courtyards.</p>
                <?php $row_no = 1; ?>
                @foreach ($cy_units_enrolled as $row)
                <tr>
                    <th>{{ $row_no++ }}</th>
                    <td>{{ $row->building }}</td>
                    <td>{{ $row->room_no}}</td>
                    <td>{{Carbon\Carbon::parse(  $row->enrollment_date )->formatLocalized('%b %d %Y')}}</td>
                    <td><a href="rooms/{{ $row->room_id }}" oncontextmenu="return false">MORE INFO</td>
                </tr>
                @endforeach
                @else
                <p class="text-danger">No newly enrolled units in Courtyards.</p>
              @endif
            </table>
        </div> 
    </div>
  
    <div class="row">
        <h3>Occupancy Rate </h3>
        <h4>Per Building</h4>
    </div>
     <div class="row">
        {!! $chart->container() !!}
    </div>
    <br>
    <div class="row">
        <h4>Per Site</h4>
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
                <h3>Courtyards</h3>
            </div>
            <div class="panel-body">
                <h1>{{ number_format($occupancy_cy, 2) }}%</h1>
            </div>
        </div>
        </div>
    </div>
   <div class="row">
       @if($move_in_rate_increase < 0)
            <h3>Move In Rate ( +{{ number_format($move_in_rate_increase,0) }} % )</h3>
       @else
            <h3>Move In Rate ( -{{ number_format($move_in_rate_increase,0) }} % )</h3>
       @endif
    </div>
     <div class="row">
        {!! $line->container() !!}
    </div>
    <br>
     <div class="row">
       @if($move_out_rate_increase > 0)
            <h3>Move Out Rate ( +{{ number_format($move_out_rate_increase,0) }} % )</h3>
       @else
            <h3>Move Out Rate ( -{{ number_format($move_out_rate_increase,0) }} % )</h3>
       @endif
    </div>
     <div class="row">
        {!! $line2->container() !!}
    </div>
    <div class="row">
       @if($collection_rate_increase > 0)
            <h3>Collection Rate ( +{{ number_format($collection_rate_increase,0) }} % )</h3>
       @else
            <h3>Collection Rate ( -{{ number_format($collection_rate_increase,0) }} % )</h3>
       @endif
    </div>
     <div class="row">
        {!! $line3->container() !!}
    </div>
</div>
<br>
{!! $chart->script() !!}
{!! $line->script() !!}
{!! $line2->script() !!}
{!! $line3->script() !!}
@endsection

