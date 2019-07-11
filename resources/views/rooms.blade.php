@extends('layouts.app')
@section('title', 'Rooms')
@section('content')
<div class="container">
    <div class="row">
        <a href="/rooms/create" oncontextmenu="return false">ADD ROOM</a>     
    </div>
    <div class="row">
        <div class="col-md-12">
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
    <div class="container">
        {{-- <p><b>{{ $room }}</b> rooms are enrolled in leasing.</p> --}}
        <div class="row">
            <table class="table table-responsive">  
                <h3>Harvard</h3>
                @foreach($harvard as $harvard)
                    @if($harvard->room_status == 'occupied')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>          
                    @elseif($harvard->room_status == 'vacant')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>
                    @elseif($harvard->room_status == 'reserved')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-warning" role="button">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%" oncontextmenu="return false">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>
                    @elseif($harvard->room_status == 'rectification')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-primary" role="button">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%" oncontextmenu="return false">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>
                    @endif
                @endforeach
            </table>
        </div>

         <div class="row">
            <table class="table table-responsive">  
                <h3>Princeton</h3>
                @foreach($princeton as $princeton)
                    @if($princeton->room_status == 'occupied')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>          
                    @elseif($princeton->room_status == 'vacant')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>
                    @elseif($princeton->room_status == 'reserved')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-warning" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>
                    @elseif($princeton->room_status == 'rectification')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-primary" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>
                    @endif
                @endforeach
            </table>
        </div>

         <div class="row">
            <table class="table table-responsive">  
                <h3>Wharton</h3>
                @foreach($wharton as $wharton)
                    @if($wharton->room_status == 'occupied')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>    
                    @elseif($wharton->room_status == 'vacant')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>
                    @elseif($wharton->room_status == 'reserved')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-warning" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>
                    @elseif($wharton->room_status == 'rectification')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-primary" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>
                    @endif
                @endforeach
            </table>
        </div>

         <div class="row">
            <table class="table table-responsive">  
                <h3>Courtyards</h2>
                @foreach($cy as $cy)
                    @if($cy->room_status == 'occupied')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>    
                    @elseif($cy->room_status == 'vacant')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>
                    @elseif($cy->room_status == 'reserved')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-warning" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>
                    @elseif($cy->room_status == 'rectification')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-primary" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
