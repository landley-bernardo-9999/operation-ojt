@extends('layouts.app')
@section('title', $room->room_no)
@section('content')
<div class="container">
@if(auth()->user()->privilege === 'leasingOfficer')
    <div class="row">
        <ul class="nav navbar-nav">   
            <li><a class="" href="{{ URL::previous() }}" oncontextmenu="return false">Back</a></li>
            <li><a class="" href="/rooms/{{ $room->room_id }}/edit" oncontextmenu="return false">Edit</a></li>
            @if($room->room_status != 'vacant')
            <li> <a title="You can't add a resident. The unit is already occupied." class="" href="#" aria-disabled="true" oncontextmenu="return false">Add Resident</a></li>
            @else
            <li><a class="" href="/residents/create/" oncontextmenu="return false">Add Resident</a></li>
            @endif
            <li><a class="" href="/owners/create/" oncontextmenu="return false">Add Owner</a></li>
            {{-- <li> 
                <form method="POST" action="/rooms/{{ $room->room_id }}">
                    @method('delete')
                    {{ csrf_field() }}
                    <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-danger">Delete</button>
                </form>
            </li> --}}
        </ul>
    </div>
@endif
    <div class="row">
        <table class="table table-borderless">
        <tr>
            <h3>Unit Information</h3>
        </tr>
        <tr>
            <td>Unit No:</td>
            <td> {{ $room->room_no }}</th>
        </tr>
         <tr>
            <td>Building:</td>
            <td> {{ $room->building }}</th>
        </tr>
        <tr>
            <td>Montly Rent: (Long Term/Short Term)/Transient:</td>
            <td> {{ number_format($room->long_term_rent, 2) }}/{{ number_format($room->short_term_rent, 2) }}/{{ number_format($room->transient, 2) }}</th>
        </tr>
              
        <tr>
            <td>Status:</td>
            <td>{{ $room->room_status }}</td>
        </tr>

        <tr>
            <td>Capacity:</td>
            <td>{{ $room->no_of_beds }}</td>
        </tr>

        <tr>
            <td>Size:</td>
            <td>{{ $room->size }}<span style="color:red">&nbspsqm</span></td>
        </tr>

        <tr>
            <td>Remarks:</td>
            <td>                    
                <b>{{ $room->remarks }}</b>
            </td>
        </tr>
        </table>
    </div>

@if(auth()->user()->privilege === 'leasingOfficer'  || auth()->user()->privilege === 'leasingManager')
    <div class="row">
        <table class="table">
            <tr>
                <h3>Owners</h3>
            </tr>
            <?php $row_no_owners = 1; ?>
            @if(!$owner->count() > 0)
            <p class="text-danger">No Owners Found.</p>
            @else
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Date Enrolled</th>
                <th></th>
            </tr>
            @foreach ($owner as $owner)
            <tr>
                <td>{{ $row_no_owners++ }}. </td>
                <td>{{ $owner->owner_first_name }} {{ $owner->owner_middle_name }} {{ $owner->owner_last_name }}</td>
                <td>{{Carbon\Carbon::parse(  $owner->enrollment_date )->formatLocalized('%b %d %Y')}}</td>
                <?php session(['sess_owner_id'=> $owner->owner_id]) ?>
                <td><a href="/owners/{{$owner->owner_id}}" oncontextmenu="return false">MORE INFO</a></td>
            </tr>
            @endforeach
            @endif

        </table>
    </div>
@endif
    <div class="row">
        <table class="table">
            <tr>
                @if(auth()->user()->privilege === 'leasingOfficer')
                    <h3>Residents</h3>
                @else
                    <h3>Contracts</h3>
                @endif
            </tr>
            <?php $row_no = 1; ?>
            @if(!$resident->count() > 0)
            @if(auth()->user()->privilege === 'leasingOfficer')
                <p class="text-danger">No Residents Found.</p>
            @else
                <p class="text-danger">No Contracts Found.</p>
            @endif
            @else
             <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Status</th>
                <th>Contract Period</th>
                <th>Term</th>
                <th></th>
            </tr>
            @foreach ($resident as $resident)
            <tr>
                <td>{{ $row_no++ }}.</td>
                <td>{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}</td>
                <td>{{ $resident->trans_status }}</td>
                <td>{{Carbon\Carbon::parse(  $resident->move_in_date )->formatLocalized('%b %d %Y')}} - {{Carbon\Carbon::parse(  $resident->move_out_date )->formatLocalized('%b %d %Y')}} </td>
                <td>{{ $resident->term }}</td>
                <td>   
                    @if(auth()->user()->privilege === 'leasingOfficer')
                        <a href="/residents/{{$resident->resident_id}}" oncontextmenu="return false">MORE INFO</a>
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>    
</div>
@endsection

