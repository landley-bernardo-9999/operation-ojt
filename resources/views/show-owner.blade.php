@extends('layouts.app')
@if(auth()->user()->privilege === 'owner' || auth()->user()->privilege === 'resident')
    @section('title',  'Profile')
@else
    @section('title',  $owner->owner_first_name." ".$owner->owner_last_name)
@endif

@section('content')
<div class="container">
    @if(auth()->user()->privilege === 'leasingOfficer')
    <div class="row">
         <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class=""href="{{ URL::previous() }}" oncontextmenu="return false"><i class="far fa-arrow-alt-circle-left"></i>&nbspBack</a>
            </li>
            <li class="">
                <a class="" href="/owners/{{ $owner->owner_id }}/edit" oncontextmenu="return false"><i class="far fa-edit"></i>&nbspEdit</a>
            </li>
            <li class="">
                <a href="/owner/room/add" oncontextmenu="return false"><i class="fas fa-home"></i>&nbspAdd Room</a>
            </li>
            
            {{-- <li class="">
                <form method="POST" action="/owners/{{ $owner->owner_id }}">
                    @method('delete')
                    {{ csrf_field() }}
                    <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-danger" >Delete</button>
                </form> 
           </li> --}}
        </ul>
    </div>
    @endif
    <div class="row">
       <div class="col-md-12">
            <table class="table">
                <tr>
                    <td><h4><b>Personal Information</b></h4></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td>{{ $owner->owner_first_name }} {{ $owner->owner_middle_name }} {{ $owner->owner_last_name }}</td>
                </tr>
                <tr>
                    <td>Birthdate:</td>
                    <td>
                        @if($owner->owner_birthdate == null)

                        @else
                            {{Carbon\Carbon::parse(  $owner->owner_birthdate )->formatLocalized('%b %d %Y')}}
                        @endif    
                    </td>
                </tr>    
                <tr>
                    <td>Gender:</td>
                    <td>{{$owner->owner_gender}}</td>
                </tr>
                <tr>
                    <td>Civil Status:</td>
                    <td>{{$owner->owner_civil_status}}</td>
                </tr>
                <tr>
                    <td>Nationality:</td>
                    <td>{{$owner->owner_nationality}}</td>
                </tr>
                <tr>
                    <td>Ethnicity:</td>
                    <td>{{$owner->owner_ethnicity}}</td>
                </tr>
                <tr>
                    <td>ID Information:</td>
                    <td>{{$owner->owner_id_info}}</td>
                </tr>
                <tr>
                        <td><h4><b>Address</b></h4></td>
                    </tr>
                    <tr>
                        <td>House Number:</td>
                        <td>{{$owner->owner_house_number}}</td>
                    </tr>
                    <tr>
                        <td>Barangay:</td>
                        <td>{{$owner->owner_barangay}}</td>
                    </tr>
                    <tr>
                        <td>Municipality:</td>
                        <td>{{$owner->owner_municipality}}</td>
                    </tr>
                    <tr>
                        <td>Province:</td>
                        <td>{{$owner->owner_province}}</td>
                    </tr>
                    <tr>
                        <td>Zip Code:</td>
                        <td>{{$owner->owner_zip}}</td>
                    </tr>
                    <tr>
                    <td><h4><b>Contact Details</b></<h4></td>
                    </tr>
                    <tr>
                        <td>Mobile Number:</td>
                        <td>{{$owner->owner_mobile_number}}</td>
                        </tr>
                    <tr>
                        <td>Telephone Number:</td>
                        <td>{{$owner->owner_telephone_number}}</td>
                    </tr>
                    <tr>
                        <td>Email Address:</td>
                        <td>{{$owner->owner_email_address}}</td>
                    </tr>
                </table>
       </div>
    </div>


    <div class="row">
            <table class="table">
            <tr>
                <td><h4><b>Authorized Representatives</b></h4></<h4></td>
            </tr>
            <?php $row_no_rep = 1; ?>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Relationship with the Unit Owner</th>
                <th>Mobile Number</th>
            </tr>
            @foreach ($representative as $representative)
            <tr>
                <th>{{ $row_no_rep++ }}</th>
                <td>{{$representative->rep_name}}</td>
                <td>{{$representative->rep_relationship}}</td>
                <td>{{$representative->rep_mobile_number}}</td>
            </tr>
            @endforeach
            </table>
        </div>

        <div class="row">
                <table class="table">
                <tr>
                    <td><h4><b>Banking Information </b></h4></<h4></td>
                </tr>
                <?php $row_no_bank = 1; ?>
                <tr>
                    <th>#</th>
                    <th>Bank Name</th>
                    <th>Account Name</th>
                    <th>Account Number</th>
                </tr>
                @foreach ($bank as $bank)
                <tr>
                    <th>{{ $row_no_bank++ }}</th>
                    <td>{{$bank->bank_name}}</td>
                    <td>{{$bank->bank_account_name}}</td>
                    <td>{{$bank->bank_account_number}}</td>
                </tr>
                @endforeach
                </table>
            </div>

</div>
@endsection
