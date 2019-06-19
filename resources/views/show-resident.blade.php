@extends('layouts.app')
@section('title',  $resident->first_name." ".$resident->last_name)
@section('content')
<div class="container">
    <div class="row">
         <div class="col-md-2">
            <a class="" href="{{ URL::previous() }}">BACK</a>
        </div>
        <div class="col-md-2">
             <p><a class="" href="">EDIT</a></p>
        </div>
        <div class="col-md-2">
            <p><a class="" href="">ADD ROOM</a></p>
        </div>
        <div class="col-md-2">
             <p><a class="" href="">ADD CO-TENANT</a></p>
        </div>
        <div class="col-md-2">
            <p><a class="" href="">TRANSFER</a></p>
       </div>
       
        <div class="col-md-2">
            <form method="POST" action="/residents/{{ $resident->resident_id }}">
                @method('delete')
                {{ csrf_field() }}
                <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="float-right">DELETE</button>
            </form> 
        </div>
      
    </div>
    <div class="row">
       <div class="col-md-9">
            <table class="table table-borderless">
                    <tr>
                        <h3>Personal Information</h3>
                    </tr>
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
                    
                    </table>
       </div>
       <div class="col-md-3">

       </div>
    </div>

     <div class="row">
        <table class="table">
                <tr>
                    <h3>Address</h3>
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
            </table>
        </div>

        
       <div class="row">
            <table class="table">
                <tr>
                    <h3>Contact Details</h3>
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


         <div class="row">
        <table class="table">
           <tr>
               <h3>Payments</h3>
           </tr>
           <?php $row_no_payments = 1; ?>
           <tr>
               <th>No.</th>
               <th>Date</th>
               <th>Desc</th>
               <th>Amt</th>
               <th>Status</th>
           </tr>
           @foreach ($payment as $payment)
           <tr>
                <td>{{ $row_no_payments }}</td>
                <td> {{Carbon\Carbon::parse(  $payment->trans_date )->formatLocalized('%b %d %Y')}}</td>
                <td>{{ $payment->desc }}</td>
                <td>{{ number_format($payment->amt, 2) }}</td>
                <td>{{ $payment->payment_status }}</td>
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
