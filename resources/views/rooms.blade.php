@extends('layouts.app')
@section('title', 'Rooms')
@section('content')
<div class="container-fluid">
    
        <div class="row">
                <div class="col-md-10">
                      <div class="row float-right text-center">
                          <div class="col-md-2">
                              <h4> Legend</h4>
                          </div> 
                          <div class="col-md-2">
                              <i class="fas fa-home fa-1x btn btn-success"></i>
                              Occupied
                          </div>      
                          <div class="col-md-2">
                              <i class="fas fa-home fa-1x btn btn-danger"></i>
                              Vacant
                          </div>
                          <div class="col-md-2">
                              <i class="fas fa-home fa-1x btn btn-warning"></i>
                              Reserved
                          </div>
                          <div class="col-md-2">
                              <i class="fas fa-home fa-1x btn btn-primary"></i>
                              Rectification 
                          </div>

                          <div class="col-md-2">
                            <i class="fas fa-plus-square"></i>
                            <a href="/rooms/create">ADD ROOM</a> 
                        </div>
                      </div>           
                </div> 

               
            </div> 
            <br>
            <div class="row">
                <div class="container">
                     <table class="table table-responsive">
                                <h2 class=""></h2>  
                            @foreach($room as $row)
                                @if($row->room_status == 'occupied')
                                <a title="{{ $row->building }}" href="/rooms/{{$row->room_id}}" class="btn btn-success" role="button">
                                    <i class="fas fa-home fa-2x"></i>
                                        <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                                            <p style="font-size: 11px">{{$row->room_no}}</p>
                                        </div>
                                </a>
                                @if($row->room_no == 'UGR East')
                                <br><br>
                                <h2 class="">Princeton</h2>
                                @endif
                                @if($row->room_no == 'UGF M')
                                <br><br>
                                <h2 class="">Wharton</h2>
                                @endif       
                                @if($row->room_no == 'W 2F 02')
                                <br><br>
                                <h2 class="">Courtyards</h2>
                                @endif            
                                @elseif($row->room_status == 'vacant')
                                    <a title="{{ $row->building }}" href="/rooms/{{$row->room_id}}" class="btn btn-danger" role="button">
                                        <i class="fas fa-home fa-2x"></i>
                                        <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                                        <p style="font-size: 11px">{{$row->room_no}}</p>
                                        </div>
                                        </a>
                                 @elseif($row->room_status == 'reserved')
                                        <a title="{{ $row->building }}" href="/rooms/{{$row->room_id}}" class="btn btn-warning" role="button">
                                            <i class="fas fa-home fa-2x"></i>
                                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                                                <p style="font-size: 11px">{{$row->room_no}}</p>
                                            </div>
                                        </a>
                                    @elseif($row->room_status == 'rectification')
                                        <a title="{{ $row->building }}"  href="/rooms/{{$row->room_id}}" class="btn btn-primary" role="button">
                                            <i class="fas fa-home fa-2x"></i>
                                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                                                <p style="font-size: 11px">{{$row->room_no}}</p>
                                            </div>
                                        </a>
                                        @endif
                                    @endforeach
                                </table>
                </div>
            </div>
   
</div>
@endsection
