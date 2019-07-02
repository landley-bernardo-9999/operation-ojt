@extends('layouts.app')
@section('title',  'Dashboard')
@section('content')
<div class="container">
     <div class="row">
        <div class="col-md-6">
                <h3>Unit Activities</h3>
            <div class="panel">
               <div class="panel-header">

               </div>
               <div class="panel-body">
                    @foreach ($move_out as $move_out)
                    <ul>
                        <li>Resident on unit {{ $move_out->room_no }} of {{ $move_out->building }} has moved out on {{Carbon\Carbon::parse(  $move_out->actual_move_out_date )->formatLocalized('%b %d %Y')}}.</li>
                    </ul>
                    @endforeach

                    @foreach ($contract as $contract)
                    <ul>
                        <li>Resident has signed a contract {{Carbon\Carbon::parse(  $contract->move_in_date )->formatLocalized('%b %d %Y')}} on unit {{ $contract->room_no }} until {{Carbon\Carbon::parse(  $contract->move_out_date )->formatLocalized('%b %d %Y')}}.</li>
                    </ul>
                    @endforeach

                    @foreach ($enrollment_date as $enrollment_date)
                    <ul>
                        <li> Unit No {{ $enrollment_date->room_no }} of {{ $enrollment_date->building }} was enrolled in leasing on {{Carbon\Carbon::parse(  $enrollment_date->enrollment_date )->formatLocalized('%b %d %Y')}}.</li>
                    </ul>
                    @endforeach 
               </div>
            </div>
        </div>

        <div class="col-md-6">
            <h3>Reminders</h3>
            <div class="panel">
                <div class="panel-header">
                  
                </div>
                <div class="panel-body">
                    <ul>
                         <li>
                           2nd General Assembly for North Cambridge Unit Owners was held June 01, 2019 on Princeton Building. 
                            Please click here
                            <embed src="" type="application/pdf" >
                        </li>
                        <li>
                           1st General Assembly for North Cambridge Unit Owners was held March 09, 2019 on Princeton Building.
                        </li>                
                    </ul>
                </div>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
                <h3>My Units</h3>
              <table class="table">
            <?php $row_no = 1; ?>
            @if(!$rooms->count() > 0)
            <p class="text-danger">No rooms Found.</p>
            @else
            <tr>
                <th>No.</th>
                <th>Building</th>
                <th>Unit No</th>
                <th>Status</th>
                <th></th>
            </tr>
            @foreach ($rooms as $rooms)
            <tr>
                <td>{{ $row_no++ }}. </td>
                <td>{{ $rooms->building }}</td>
                <td>{{ $rooms->room_no }}</td>
                <td>{{ $rooms->room_status }}</td>
                <td><a href="/rooms/{{$rooms->room_id}}" oncontextmenu="return false">MORE INFO</a></td>
            </tr>
            @endforeach
            @endif

        </table>
        </div>
    </div>
</div>
@endsection
