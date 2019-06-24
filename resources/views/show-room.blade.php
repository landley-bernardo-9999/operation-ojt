@extends('layouts.app')
@section('title', session('sess_room_no'))
@section('content')
<div class="container">
    <div class="row">
       <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::previous() }}">Back</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Edit</a>
            </li>
            <li class="nav-item">
                @if($room->room_status != 'vacant')
                    <a title="You can't add a resident. The unit is already occupied." class="nav-link" href="#" aria-disabled="true">Add Resident</a>
                @else
                    <a class="nav-link" href="/residents/create/">Add Resident</a>
                @endif
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/owners/create/">Add Owner</a>
            </li>
            
            <li class="nav-item">
                <form method="POST" action="/rooms/{{ $room->room_id }}">
                    @method('delete')
                    {{ csrf_field() }}
                    <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-danger nav-link">Delete</button>
                </form>
            </li>
        </ul>
    </div>
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
            <td>Montly Rent: (Long Term/Short Term):</td>
            <td> {{ number_format($room->long_term_rent, 2) }}/{{ number_format($room->short_term_rent, 2) }}</th>
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

    <div class="row">
        <table class="table">
            <tr>
                <h3>Owners</h3>
            </tr>
            <?php $row_no_owners = 1; ?>
            @if(!$owner->count() > 0)
            <p>No Owners Found.</p>
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
                <td><a href="/owners/{{$owner->owner_id}}">MORE INFO</a></td>
            </tr>
            @endforeach
            @endif

        </table>
    </div>

    <div class="row">
        <table class="table">
            <tr>
                <h3>Residents</h3>
            </tr>
            <?php $row_no = 1; ?>
            @if(!$resident->count() > 0)
            <p>No Residents Found.</p>
                
            @else
             <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Status</th>
                <th>Contract Period</th>
                <th></th>
            </tr>
            @foreach ($resident as $resident)
            <tr>
                <td>{{ $row_no++ }}.</td>
                <td>{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}</td>
                <td>{{ $resident->trans_status }}</td>
                <td>{{Carbon\Carbon::parse(  $resident->move_in_date )->formatLocalized('%b %d %Y')}} - {{Carbon\Carbon::parse(  $resident->move_out_date )->formatLocalized('%b %d %Y')}}</td>
                <td><a href="/residents/{{$resident->resident_id}}">MORE INFO</a></td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>

    <div class="row">
        <table class="table">
            <tr>
                <h3>Repairs</h3>
            </tr>
        </table>
    </div>
    
</div>
@endsection

