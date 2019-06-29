@extends('layouts.app')
@section('title',  $owner->owner_first_name." ".$owner->owner_last_name)
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
                <a href="/owner/room/add">Add Room</a>
            </li>
            @if(auth()->user()->privilege === 'leasingOfficer')
            <li class="nav-item">
                <form method="POST" action="/owners/{{ $owner->owner_id }}">
                    @method('delete')
                    {{ csrf_field() }}
                    <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-danger" >Delete</button>
                </form> 
           </li>
           @endif
        </ul>
      
    </div>
    <div class="row">
       <div class="col-md-9">
            <table class="table">
                <tr>
                    <h3>Personal Information</h3>
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
            </table>
       </div>

       <div class="col-md-3">
           <img src="/storage/owner_img/nophoto.png" alt="..." class="img-thumbnail">
       </div>
    </div>

     <div class="row">
        <table class="table">
                <tr>
                    <h3>Address</h3>
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
            </table>
        </div>

       <div class="row">
            <table class="table">
                <tr>
                    <h3>Contact Details</h3>
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

        <div class="row">
            <table class="table">
               <tr>
                   <h3>Representative</h3>
               </tr>
               @foreach ($representative as $representative)
               <tr>
                    <td>Name:</td>
                    <td>{{$representative->rep_name}}</td>
               </tr>
               <tr>
                    <td>Relationship with the Unit Owner:</td>
                    <td>{{$representative->rep_relationship}}</td>
               </tr>
               <tr>
                    <td>Mobile Number:</td>
                    <td>{{$representative->rep_mobile_number}}</td>
               </tr>
               @endforeach
            </table>
        </div>

    <div class="row">
            <table class="table">
               <tr>
                   <h3>Bank Details</h3>
               </tr>
               @foreach ($bank as $bank)
               <tr>
                    <td>Bank Name:</td>
                    <td>{{$bank->bank_name}}</td>
               </tr>
               <tr>
                    <td>Bank Account Name:</td>
                    <td>{{$bank->bank_account_name}}</td>
               </tr>
               <tr>
                    <td>Bank Account Number:</td>
                    <td>{{$bank->bank_account_number}}</td>
               </tr>
               @endforeach
            </table>
        </div>

    <div class="row">
        <table class="table">
           <tr>
               <h3>Units</h3>
           </tr>
           <?php $row_no_units = 1; ?>
           <tr>
               <th>No.</th>
               <th>Unit No</th>
               <th>Building</th>
               <th>Date Enrolled</th>
               <th></th>
           </tr>
           @foreach ($contract as $contract)
           <tr>
                <td>
                    {{ $row_no_units++ }}.
                </td>
                <td>
                   {{ $contract->room_no }}
                </td>
                <td>
                    {{ $contract->building }}
                </td>
                <td>
                    {{Carbon\Carbon::parse(  $contract->enrollment_date )->formatLocalized('%b %d %Y')}}
                </td>
                <td><a href="/rooms/{{ $contract->contract_room_id }}">MORE INFO</a></td>
           </tr>
           @endforeach
        </table>
    </div>

    <div class="row">
        <table class="table">
           <tr>
               <h3>Transactions</h3>
           </tr>
           <?php $row_no_trans = 1; ?>
           <tr>
               <th>No.</th>
               <th>Unit No</th>
               <th>Building</th>
               <th>Contract Period</th>
               <th>Contract Status</th>
               <th>Montly Rent</th>
           </tr>
           @foreach ($transaction as $transaction)
           <tr>
                <td>
                    {{ $row_no_trans++ }}.
                </td>
                <td>
                   {{ $transaction->room_no }}
                </td>
                <td>
                    {{ $transaction->building }}
                </td>
                <td>
                    {{Carbon\Carbon::parse(  $transaction->move_in_date )->formatLocalized('%b %d %Y')}} - {{Carbon\Carbon::parse(  $transaction->move_out_date )->formatLocalized('%b %d %Y')}} 
                </td>
                <td>
                    {{ $transaction->trans_status }}
                </td>
                <td>
                    @if($transaction->term == 'long_term')
                        {{ number_format($transaction->long_term_rent, 2) }}
                    @elseif($transaction->term == 'short_term')
                        {{ number_format($transaction->short_term_rent, 2) }}
                    @endif
                </td>
           </tr>
           @endforeach
          
        </table>
    </div>

    <div class="row">
            <table class="table">
               <tr>
                   <h3>Repairs</h3>
               </tr>
               <?php $row_no_trans = 1; ?>
               <tr>
                   <th>No.</th>
                   <th>Unit No</th>
                   <th>Building</th>
                   <th>Contract Period</th>
                   <th>Contract Status</th>
                   <th>Montly Rent</th>
               </tr>
             
              
            </table>
        </div>

    
</div>
@endsection
