@extends('layouts.app')
@section('title',  'Dashboard')
@section('content')
<div class="container">
     <div class="row">
        <div class="col-md-6">
                <h3>Units</h3>

                 <div class="panel">
               <div class="panel-header">
                    
               </div>
               <div class="panel-body">
                        <table class="table">
                    
                        @if(!$rooms->count() > 0)
                        <p class="text-danger">No units Found.</p>
                        @else
                        <tr>
                            <th>Unit</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        @foreach ($rooms as $rooms)
                        <tr>
                            
                            <td>{{ $rooms->building }} {{ $rooms->room_no }}</td>
                            
                            <td>{{ $rooms->room_status }}  </td>
    
                          
                           
                            <td><a href="/rooms/{{$rooms->room_id}}" oncontextmenu="return false">OPEN</a></td>
                        </tr>
                        @endforeach
                        @endif
                </table>
               </div>
            </div>

            <div class="panel">
               <div class="panel-header">
                    <b>Activities</b>
               </div>
               <div class="panel-body">
                    @foreach ($move_out as $move_out)
                    
                        <p>Resident on unit {{ $move_out->room_no }} of {{ $move_out->building }} has moved out on {{Carbon\Carbon::parse(  $move_out->actual_move_out_date )->formatLocalized('%b %d %Y')}}.</p>
                    
                    @endforeach

                    @foreach ($contract as $contract)
                    
                        <p>Resident has signed a contract {{Carbon\Carbon::parse(  $contract->move_in_date )->formatLocalized('%b %d %Y')}} on unit {{ $contract->room_no }} until {{Carbon\Carbon::parse(  $contract->move_out_date )->formatLocalized('%b %d %Y')}}.</p>
                    
                    @endforeach

                    @foreach ($enrollment_date as $enrollment_date)
                    
                        <p> Unit No {{ $enrollment_date->room_no }} of {{ $enrollment_date->building }} was enrolled in leasing on {{Carbon\Carbon::parse(  $enrollment_date->enrollment_date )->formatLocalized('%b %d %Y')}}.</p>
                    
                    @endforeach 
               </div>
            </div>

           


            <div class="panel">
               <div class="panel-header">
                    <b>Remittances</b>
               </div>
               <div class="panel-body">
                        <table class="table">   
                        <tr>
                            <td>Short Term</td>
                        </tr>
                        <tr>
                            <th>Unit</th>
                            <th>Rent</th>
                            <th>Mgmt Fee</th>
                            <th>Condo Dues</th>
                            <th>Net</th>
                           
                        </tr>
                        @foreach ($short_term_rent as $short_term_rent)
                        <tr>
                            <td>{{ $short_term_rent->building }} {{ $short_term_rent->room_no }}</td>
                            <td>{{ number_format($short_term_rent->short_term_rent,2) }}</td>
                            @if($short_term_rent->building === 'harvard')
                                <td>{{ $short_term_rent->short_term_rent * 0.2}} </td>
                            @elseif($short_term_rent->building === 'princeton')
                                <td>1700</td> 
                            @elseif($short_term_rent->building === 'wharton')
                                <td>{{ $short_term_rent->short_term_rent * 0.2}} </td> 
                            @endif
                            
                            <td>{{ $short_term_rent->size * 58.61}} </td>
                            @if($short_term_rent->building === 'harvard')
                            <th>{{  $short_term_rent->short_term_rent - (($short_term_rent->size * 58.61) + ($short_term_rent->short_term_rent * 0.2))  }} </th>
                            @elseif($short_term_rent->building === 'princeton')
                            <th>{{  $short_term_rent->short_term_rent - (($short_term_rent->size * 58.61) + (1700))  }} </th> 
                            @elseif($short_term_rent->building === 'wharton')
                            <th>{{  $short_term_rent->short_term_rent - (($short_term_rent->size * 58.61) + ($short_term_rent->short_term_rent * 0.2))  }} </th> 
                            @endif
                            
                        </tr>
                        @endforeach

                        <tr>
                            <td>Long Term</td>
                        </tr>
                        <tr>
                            <th>Unit</th>
                            <th>Rent</th>
                            <th>Mgmt Fee</th>
                            <th>Condo Dues</th>
                            <th>Net</th>
                         
                        </tr>
                        @foreach ($long_term_rent as $long_term_rent)
                        <tr>
                            <td>{{ $long_term_rent->building }} {{ $long_term_rent->room_no }}</td>
                            <td>{{ number_format($long_term_rent->long_term_rent,2) }}</td>
                            @if($short_term_rent->building === 'harvard')
                                <td>780</td>
                            @elseif($long_term_rent->building === 'princeton')
                                <td> 1200</td>
                            @elseif($long_term_rent->building === 'wharton')
                                <td>1500</td>
                            @endif
                            <td>{{ $long_term_rent->size * 58.61}} </td>
                            @if($short_term_rent->building === 'harvard')
                            <th>{{  $long_term_rent->long_term_rent - (($long_term_rent->size * 58.61) + (780))  }} </th>
                            @elseif($long_term_rent->building === 'princeton')
                            <th>{{  $long_term_rent->long_term_rent - (($long_term_rent->size * 58.61) + (1200))  }} </th> 
                            @elseif($long_term_rent->building === 'wharton')
                            <th>{{  $long_term_rent->long_term_rent - (($long_term_rent->size * 58.61) + (1500))  }} </th> 
                            @endif
                        </tr>
                        @endforeach
                </table>
               </div>
            </div>
        </div>

        <div class="col-md-6">
            <h3>Reminders</h3>
            <div class="panel">
                <div class="panel-header">
                    <b>Events</b>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>
                            The propose increase for the condominium has been concluded and the implemented has taken effect this June 2019.
                        </li>
                         <li>
                           2nd General Assembly for North Cambridge Unit Owners was held June 01, 2019 on Princeton Building. 
                        </li>
                        <li>
                           1st General Assembly for North Cambridge Unit Owners was held March 09, 2019 on Princeton Building.
                        </li>    
                        <li>
                           <b> Schedule for remittance is every 2nd week of the month. For inquiries and other concerns regarding remittance please get in touch with the Billing Department.</b>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                  <b>Directories</b>
                </div>
                <div class="panel-body">
                   <table class="table">
                       <tr>
                           <th>PROPERTY MANAGEMENT OFFICE</th>
                           <th></th>
                       </tr>
                       <tr>
                           <td>ADMIN</td>
                           <td>0912-6976-504/(074)246-0548</td>
                       </tr>
                       <tr>
                           <td>TREASURY</td>
                           <td>0998-465-8645</td>
                       </tr>
                       <tr>
                           <td>BILLING</td>
                           <td>0955-702-0374</td>
                       </tr>
                        <tr>
                           <th>LEASING DEPARTMENT OFFICE</th>
                           <th></th>
                       </tr>
                       <tr>
                           <td>NC ADMIN</td>
                           <td>0946-162-0033</td>
                       </tr>
                       <tr>
                           <td>CY ADMIN</td>
                           <td>0996-138-0775</td>
                       </tr>
                       <tr>
                           <td>BILLING</td>
                           <td>0946-757-6159/0906-875-8142</td>
                       </tr>
                       <tr>
                           <th>EMERGENCY CONTACT NUMBER</th>
                       </tr>
                       <tr>
                           <td>Benguet Police Provincial Office</td>
                           <td>09985987780/074-442-2222</td>
                       </tr>
                       <tr>
                           <td>Baguio Fire Station</td>
                           <td>074-422-1131</td>
                       </tr>
                       <tr>
                           <td>Emergency Medical Service</td>
                           <td>0925-493-4851/074-442-1911</td>
                       </tr>
                    </table>
                </td>
            </div>
        </div>

        <div class="panel">
                <div class="panel-header">
                  <b>Downloadables</b>
                </div>
                <div class="panel-body">
                    <ol>
                        <li>SAMPLE UNIT ENROLLMENT CONTRACT</li>
                        <ul>
                            <li><a href="/storage/files/lessor/harvard/LESSEE-CONTRACT-HARVARD-LONG-TERM.pdf" target="_blank">HARVARD</a></li>
                            <li><a href="/storage/files/lessor/princeton/LESSEE-CONTRACT-PRINCETON-LONG-TERM.pdf" target="_blank">PRINCETON</a></li>
                            <li><a href="/storage/files/lessor/wharton/LESSEE-CONTRACT-WHARTON-LONG-TERM.pdf" target="_blank">WHARTON</a></li>
                        </ul>   
                        <li>SAMPLE RESIDENT CONTRACT</li>
                        <ul>
                            <li><a href="/storage/files/lessee/harvard/LESSEE-CONTRACT-HARVARD-LONG-TERM.pdf" target="_blank">HARVARD</a></li>
                            <li><a href="/storage/files/lessee/princeton/LESSEE-CONTRACT-PRINCETON-LONG-TERM.pdf" target="_blank">PRINCETON</a></li>
                            <li><a href="/storage/files/lessee/wharton/LESSEE-CONTRACT-WHARTON-LONG-TERM.pdf" target="_blank">WHARTON</a></li>
                        </ul>   
                        <li>
                            HOUSE RULES AND REGULATIONS
                        </li>    
                        <ul>
                            <li><a href="/storage/files/NC-House-Rules-Revised-2014-booklet.pdf" target="_blank">NORTH CAMBRIDGE</a></li>
                            <li><a href="/storage/files/NC-House-Rules-Revised-2014-booklet.pdf" target="_blank">COURTYARDS</a></li>
                        </ul>
                    </ol>
                 
            </div>
        </div>
    </div>
</div>
@endsection
