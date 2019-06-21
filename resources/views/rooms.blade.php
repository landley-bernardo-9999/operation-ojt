@extends('layouts.app')
@section('title', 'Rooms')
@section('content')
<div class="container">
    <div class="row">
        <a href="/rooms/create">ADD ROOM</a>     
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
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
        </div> 
    </div> 
    <br><br>
    <div class="row">
        <div class="container">
            <table class="table table-responsive">  
                @foreach($room as $row)
                    @if($row->room_status == 'occupied')
                        <a href="/rooms/{{$row->room_id}}" class="btn btn-success" role="button">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around;>
                            <p style="font-size: 11px">{{$row->room_no}}</p>
                            </div>
                        </a>          
                    @elseif($row->room_status == 'vacant')
                        <a href="/rooms/{{$row->room_id}}" class="btn btn-danger" role="button">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$row->room_no}}</p>
                            </div>
                        </a>
                    @elseif($row->room_status == 'reserved')
                        <a href="/rooms/{{$row->room_id}}" class="btn btn-warning" role="button">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$row->room_no}}</p>
                            </div>
                        </a>
                    @elseif($row->room_status == 'rectification')
                        <a href="/rooms/{{$row->room_id}}" class="btn btn-primary" role="button">
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
