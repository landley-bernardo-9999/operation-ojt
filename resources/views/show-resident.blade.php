@extends('layouts.app')
@if(auth()->user()->privilege === 'owner' || auth()->user()->privilege === 'resident')
    @section('title',  'Profile')
@else
    @section('title',  $resident->first_name." ".$resident->last_name)
@endif
@section('content')
<div class="container">
        @if(auth()->user()->privilege === 'leasingOfficer')
    <div class="row">
        <ul class="nav navbar-nav">
            <li class="">
                <a class="" href="/rooms/{{ session('sess_room_id') }}" oncontextmenu="return false"><i class="far fa-arrow-alt-circle-left"></i>&nbspBack</a>
            </li>
            <li class="">
                <a class="" href="#" oncontextmenu="return false"><i class="fas fa-user-edit"></i>&nbspEdit</a>
            </li>
            <li class="">
                <a href="/co-tenant/create" oncontextmenu="return false"><i class="fas fa-user-plus"></i>&nbspAdd Co-Tenant</a>
            </li>
            <li class="">
                <a href="/room/add" oncontextmenu="return false"><i class="far fa-edit"></i>&nbspAdd/Renewal/Transfer Contract</a>
            </li>
            <li class="">
                <a href="#" oncontextmenu="return false">Add Repair</a>
            </li>
            <li class="">
                <a href="#" oncontextmenu="return false">Add Violation</a>
            </li>
             {{-- <li class="nav-item">
                <form method="POST" action="/residents/{{ $resident->resident_id }}">
                    @method('delete')
                    {{ csrf_field() }}
                    <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-danger">Delete</button>
                </form>
            </li> --}}
        </ul>
    </div>
    @endif
    <div class="row">
       <div class="col-md-12">
            <table class="table">
                        <p><h4><b> Personal Information</b></h4></p>
                    <tr>
                        <td>Name:</td>
                        <td>{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }} </td>
                    </tr>
                    <tr>
                        <td>Birthdate:</td>
                        <td>{{Carbon\Carbon::parse(  $resident->birthdate )->formatLocalized('%b %d %Y')}}</td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td>{{$resident->gender}}</td>
                    </tr>
                     <tr>
                        <td>Civil Status:</td>
                        <td>{{$resident->civil_status}}</td>
                    </tr>
                     <tr>
                        <td>Nationality:</td>
                        <td>{{$resident->nationality}}</td>
                    </tr>
                    <tr>
                        <td>Ethnicity:</td>
                        <td>{{$resident->ethnicity}}</td>
                    </tr>
                    <tr>
                        <td>ID Information:</td>
                        <td>{{$resident->id_info}}</td>
                    </tr>
                    
                <tr>
                    <td><h4><b>Address</b></h4></td>
                </tr>
                <tr>
                    <td>House Number:</td>
                    <td>{{$resident->house_number}}</td>
                </tr>
                <tr>
                    <td>Barangay:</td>
                    <td>{{$resident->barangay}}</td>
                </tr>
                <tr>
                    <td>Municipality:</td>
                    <td>{{$resident->municipality}}</td>
                </tr>
                <tr>
                    <td>Province:</td>
                    <td>{{$resident->province}}</td>
                </tr>
                <tr>
                    <td>Zip Code:</td>
                    <td>{{$resident->zip}}</td>
                </tr>  
                <tr>
                    <td><h4><b>Contact Details</b></h4></td>
                </tr>
                <tr>
                    <td>Mobile Number:</td>
                    <td>{{$resident->mobile_number}}</td>
                </tr>
                <tr>
                    <td>Telephone Number:</td>
                    <td>{{$resident->telephone_number}}</td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td>{{$resident->email_address}}</td>
                </tr>  
            </table>
       </div>
    </div>
        <div class="row">
            <table class="table">
               <p><h4><b> Guardian</b></h4></p>
                @if($guardian->count() > 0)
            <?php $row_no_co_guardian = 1; ?>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Relationship</th>
                <th>Mobile Number</th>
            </tr>
            @foreach ($guardian as $guardian)
            <tr>
                <th>{{ $row_no_co_guardian++ }}</th>
                <td> {{ $guardian->name }} </td>
                <td> {{ $guardian->relationship }} </td>
                <td> {{ $guardian->mobile_number }} </td>
            </tr>
            @endforeach
            @else
            <p class="text-danger">No guardians declared.</p>
          @endif
            </table>
        </div>

        <div class="row">
            <table class="table">
                <p><h4><b>Co-Residents</b></h4></<h4></p>
                @if($co_residents->count() > 0)
            <?php $row_no_co_residents = 1; ?>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Telephone Number</th>
                <th>Email Address</th>
            </tr>
            @foreach ($co_residents as $co_residents)
            <tr>
                <th>{{ $row_no_co_residents++ }}</th>
                <td> {{ $co_residents->first_name }} {{ $co_residents->middle_name }} {{ $co_residents->last_name }}</td>
                <td> {{ $co_residents->mobile_number }} </td>
                <td> {{ $co_residents->telephone_number }} </td>
                <td> {{ $co_residents->email_address }} </td>
            </tr>
            @endforeach
            @else
            <p class="text-danger">No co-residents declared.</p>
          @endif
            </table>
        </div>

    <div class="row">
        <table class="table">
            <p><h4><b>Contracts</b></<h4></p>        
           <?php $row_no_contracts = 1; ?>
           <tr>
               <th>#</th>
               <th>Unit No</th>
               <th>Building</th>
               <th>Contract Period</th>
               <th>Contract Status</th>
               <th>Montly Rent</th>
               <th></th>
           </tr>
           @foreach ($contract as $contract)
           <tr>
                <th>
                    {{ $row_no_contracts++ }}
                </th>
                <td>
                   {{ $contract->room_no }}
                </td>
                <td>
                    {{ $contract->building }}
                </td>
                <td>
                    {{Carbon\Carbon::parse(  $contract->move_in_date )->formatLocalized('%b %d %Y')}} - {{Carbon\Carbon::parse(  $contract->move_out_date )->formatLocalized('%b %d %Y')}} 
                </td>
                <td>
                    {{ $contract->trans_status }}
                </td>
                <td>
                    @if($contract->term == 'long_term')
                        {{ number_format($contract->long_term_rent, 2) }}
                    @elseif($contract->term == 'short_term')
                        {{ number_format($contract->short_term_rent, 2) }}
                    @else   
                        {{ number_format($contract->transient, 2) }} - transient
                    @endif
                </td>
                <td><a href="/transactions/{{ $contract->trans_id }}" oncontextmenu="return false">MORE INFO</a></td>
           </tr>
           @endforeach
          
        </table>
    </div>

    <div class="row">
        <table class="table">
               <p><h4><b> Payments</b></<h4`></p>
           <?php $row_no_payments = 1; ?>
           <tr>
               <th>#</th>
               <th>Date</th>
               <th>Description</th>
               <th>Amount</th>
               <th>Status</th>
           </tr>
           @foreach ($payment as $payment)
           <tr>
                <th>{{ $row_no_payments++ }}</th>
                <td> {{Carbon\Carbon::parse(  $payment->billing_date )->formatLocalized('%b %d %Y')}}</td>
                <td>{{ $payment->desc }}</td>
                <td>{{ number_format($payment->amt, 2) }}</td>
                <td>{{ $payment->payment_status }}</td>
           </tr>
           @endforeach
        </table>
    </div>
</div>
@endsection
