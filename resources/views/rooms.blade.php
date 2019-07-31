@extends('layouts.app')
@section('title', 'Rooms')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="/rooms/create" oncontextmenu="return false"><i class="fas fa-home"></i>&nbspAdd Room</a>   
        </div>  
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
                <h1>Harvard</h1>
                <p>{{ $harvard->count() }} units under leasing.</p>
                @foreach($harvard as $harvard)
                    @if($harvard->room_status == 'occupied')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>      
                         @if($harvard->room_no === 'LGR East' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($harvard->room_no === 'UGQ East' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($harvard->room_no === 'GLR West' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($harvard->room_no === '2LR East' )
                            <br>
                            <p>2nd Floor </p>
                        @elseif($harvard->room_no === '3LQ East' )
                            <br>
                            <p>3rd Floor </p>
                        @elseif($harvard->room_no === '4LR West' )
                            <br>
                            <p>4th Floor </p>
                        @elseif($harvard->room_no === '5LR West' )
                            <br>
                            <p>5th Floor </p>
                        @elseif($harvard->room_no === '6LR East' )
                            <br>
                            <p>6th Floor </p>
                        @endif           
                    @elseif($harvard->room_status == 'vacant')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>
                        @if($harvard->room_no === 'LGR East' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($harvard->room_no === 'UGQ East' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($harvard->room_no === 'GLR West' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($harvard->room_no === '2LR East' )
                            <br>
                            <p>2nd Floor </p>
                        @elseif($harvard->room_no === '3LQ East' )
                            <br>
                            <p>3rd Floor </p>
                        @elseif($harvard->room_no === '4LR West' )
                            <br>
                            <p>4th Floor </p>
                        @elseif($harvard->room_no === '5LR West' )
                            <br>
                            <p>5th Floor </p>
                        @elseif($harvard->room_no === '6LR East' )
                            <br>
                            <p>6th Floor </p>
                        @endif         
                    @elseif($harvard->room_status == 'reserved')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-warning" role="button">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%" oncontextmenu="return false">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>
                         @if($harvard->room_no === 'LGR East' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($harvard->room_no === 'UGQ East' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($harvard->room_no === 'GLR West' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($harvard->room_no === '2LR East' )
                            <br>
                            <p>2nd Floor </p>
                        @elseif($harvard->room_no === '3LQ East' )
                            <br>
                            <p>3rd Floor </p>
                        @elseif($harvard->room_no === '4LR West' )
                            <br>
                            <p>4th Floor </p>
                        @elseif($harvard->room_no === '5LR West' )
                            <br>
                            <p>5th Floor </p>
                        @elseif($harvard->room_no === '6LR East' )
                            <br>
                            <p>6th Floor </p>
                        @endif         
                    @elseif($harvard->room_status == 'rectification')
                        <a href="/rooms/{{$harvard->room_id}}" class="btn btn-primary" role="button">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%" oncontextmenu="return false">
                            <p style="font-size: 11px">{{$harvard->room_no}}</p>
                            </div>
                        </a>
                         @if($harvard->room_no === 'LGR East' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($harvard->room_no === 'UGQ East' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($harvard->room_no === 'GLR West' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($harvard->room_no === '2LR East' )
                            <br>
                            <p>2nd Floor </p>
                        @elseif($harvard->room_no === '3LQ East' )
                            <br>
                            <p>3rd Floor </p>
                        @elseif($harvard->room_no === '4LR West' )
                            <br>
                            <p>4th Floor </p>
                        @elseif($harvard->room_no === '5LR West' )
                            <br>
                            <p>5th Floor </p>
                        @elseif($harvard->room_no === '6LR East' )
                            <br>
                            <p>6th Floor </p>
                        @endif         
                    @endif
                @endforeach
            </table>
        </div>
<hr>
         <div class="row">
            <table class="table table-responsive">  
                <h1>Princeton</h1>
                <p>{{ $princeton->count() }} units under leasing.</p>
                @foreach($princeton as $princeton)
                    @if($princeton->room_status == 'occupied')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>      
                        @if($princeton->room_no === '3LGF B' )
                            <br>
                            <p>3rd Lower Ground </p>
                        @elseif($princeton->room_no === '2LGF D' )
                            <br>
                            <p>2nd Lower Ground </p>
                        @elseif($princeton->room_no === 'LGF K' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($princeton->room_no === 'UGF M' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($princeton->room_no === 'GF K' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($princeton->room_no === '2F L' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($princeton->room_no === 'P 3F 12' )
                            <br>
                            <p>3rd Floor</p>
                        @elseif($princeton->room_no === 'P 4F 01' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($princeton->room_no === '5FL-5FM' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($princeton->room_no === '6F K' )
                            <br>
                            <p>6th Floor</p>
                        @endif   
                    @elseif($princeton->room_status == 'vacant')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>
                          @if($princeton->room_no === '3LGF B' )
                            <br>
                            <p>3rd Lower Ground </p>
                        @elseif($princeton->room_no === '2LGF D' )
                            <br>
                            <p>2nd Lower Ground </p>
                        @elseif($princeton->room_no === 'LGF K' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($princeton->room_no === 'UGF M' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($princeton->room_no === 'GF K' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($princeton->room_no === '2F L' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($princeton->room_no === 'P 3F 12' )
                            <br>
                            <p>3rd Floor</p>
                        @elseif($princeton->room_no === 'P 4F 01' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($princeton->room_no === '5FL-5FM' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($princeton->room_no === '6F K' )
                            <br>
                            <p>6th Floor</p>
                        @endif   
                    @elseif($princeton->room_status == 'reserved')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-warning" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>
                        @if($princeton->room_no === '3LGF B' )
                            <br>
                            <p>3rd Lower Ground </p>
                        @elseif($princeton->room_no === '2LGF C' )
                            <br>
                            <p>2nd Lower Ground </p>
                        @elseif($princeton->room_no === 'LGF K' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($princeton->room_no === 'UGF M' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($princeton->room_no === 'GF K' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($princeton->room_no === '2F L' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($princeton->room_no === 'P 3F 12' )
                            <br>
                            <p>3rd Floor</p>
                        @elseif($princeton->room_no === 'P 4F 01' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($princeton->room_no === '5FL-5FM' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($princeton->room_no === '6F K' )
                            <br>
                            <p>6th Floor</p>
                        @endif   
                    @elseif($princeton->room_status == 'rectification')
                        <a href="/rooms/{{$princeton->room_id}}" class="btn btn-primary" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$princeton->room_no}}</p>
                            </div>
                        </a>
                        @if($princeton->room_no === '3LGF B' )
                            <br>
                            <p>3rd Lower Ground </p>
                        @elseif($princeton->room_no === '2LGF C' )
                            <br>
                            <p>2nd Lower Ground </p>
                        @elseif($princeton->room_no === 'LGF K' )
                            <br>
                            <p>Lower Ground </p>
                        @elseif($princeton->room_no === 'UGF M' )
                            <br>
                            <p>Upper Ground </p>
                        @elseif($princeton->room_no === 'GF K' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($princeton->room_no === '2F L' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($princeton->room_no === 'P 3F 12' )
                            <br>
                            <p>3rd Floor</p>
                        @elseif($princeton->room_no === 'P 4F 01' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($princeton->room_no === '5FL-5FM' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($princeton->room_no === '6F K' )
                            <br>
                            <p>6th Floor</p>
                        @endif   
                    @endif
                @endforeach
            </table>
        </div>
<hr>
         <div class="row">
            <table class="table table-responsive">  
                <h1>Wharton</h1>
                <p>{{ $wharton->count() }} units under leasing.</p>
                @foreach($wharton as $wharton)
                    @if($wharton->room_status == 'occupied')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>    
                        @if($wharton->room_no === 'GF 29' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($wharton->room_no === '2F 27' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($wharton->room_no === '3F 9' )
                            <br>
                            <p>3nd Floor</p>
                        @elseif($wharton->room_no === '4F 25' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($wharton->room_no === '5F 30' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($wharton->room_no === '6F 26' )
                            <br>
                            <p>6th Floor</p>
                        @endif
                    @elseif($wharton->room_status == 'vacant')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>
                        @if($wharton->room_no === 'GF 29' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($wharton->room_no === '2F 27' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($wharton->room_no === '3F 9' )
                            <br>
                            <p>3nd Floor</p>
                        @elseif($wharton->room_no === '4F 25' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($wharton->room_no === '5F 30' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($wharton->room_no === '6F 26' )
                            <br>
                            <p>6th Floor</p>
                        @endif
                    @elseif($wharton->room_status == 'reserved')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-warning" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>
                        @if($wharton->room_no === 'GF 29' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($wharton->room_no === '2F 27' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($wharton->room_no === '3F 9' )
                            <br>
                            <p>3nd Floor</p>
                        @elseif($wharton->room_no === '4F 25' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($wharton->room_no === '5F 30' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($wharton->room_no === '6F 26' )
                            <br>
                            <p>6th Floor</p>
                        @endif
                    @elseif($wharton->room_status == 'rectification')
                        <a href="/rooms/{{$wharton->room_id}}" class="btn btn-primary" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$wharton->room_no}}</p>
                            </div>
                        </a>
                        @if($wharton->room_no === 'GF 29' )
                            <br>
                            <p>Ground Floor</p>
                        @elseif($wharton->room_no === '2F 27' )
                            <br>
                            <p>2nd Floor</p>
                        @elseif($wharton->room_no === '3F 9' )
                            <br>
                            <p>3nd Floor</p>
                        @elseif($wharton->room_no === '4F 25' )
                            <br>
                            <p>4th Floor</p>
                        @elseif($wharton->room_no === '5F 30' )
                            <br>
                            <p>5th Floor</p>
                        @elseif($wharton->room_no === '6F 26' )
                            <br>
                            <p>6th Floor</p>
                        @endif
                    @endif
                @endforeach
            </table>
        </div>
        <hr>
         <div class="row">
            <table class="table table-responsive">  
                <h1>Courtyards</h1>
                    <p>{{ $cy->count() }} units under leasing.</p>
                @foreach($cy as $cy)
                    @if($cy->room_status == 'occupied')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-success" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>    
                        @if($cy->room_no === 'CB 4B')
                            <br>
                            <p>Arkansas</p>
                        @elseif($cy->room_no === 'CA 3B')
                            <br>
                            <p>Colorado</p>
                        @elseif($cy->room_no === '313')
                            <br>
                            <p>Loft</p>
                        @elseif($cy->room_no === '509')
                            <br>
                            <p>Manors</p>
                        @endif
                    @elseif($cy->room_status == 'vacant')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-danger" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>
                        @if($cy->room_no === 'CB 4B' )
                            <br>
                            <p>Arkansas</p>
                        @elseif($cy->room_no === 'CA 3B')
                            <br>
                            <p>Colorado</p>
                        @elseif($cy->room_no === '313')
                            <br>
                            <p>Loft</p>
                        @elseif($cy->room_no === '509')
                            <br>
                            <p>Manors</p>
                        @endif
                    @elseif($cy->room_status == 'reserved')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-warning" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>
                         @if($cy->room_no === 'CB 4B' )
                            <br>
                            <p>Arkansas</p>
                        @elseif($cy->room_no === 'CA 3B')
                            <br>
                            <p>Colorado</p>
                        @elseif($cy->room_no === '313')
                            <br>
                            <p>Loft</p>
                        @elseif($cy->room_no === '509')
                            <br>
                            <p>Manors</p>
                        @endif
                    @elseif($cy->room_status == 'rectification')
                        <a title= "{{ $cy->building }}" href="/rooms/{{$cy->room_id}}" class="btn btn-primary" role="button" oncontextmenu="return false">
                            <i class="fas fa-home fa-2x"></i>
                            <div style="display: flex; width: 30px; justify-content: space-around; margin-bottom:-60%">
                            <p style="font-size: 11px">{{$cy->room_no}}</p>
                            </div>
                        </a>
                         @if($cy->room_no === 'CB 4B' )
                            <br>
                            <p>Arkansas</p>
                        @elseif($cy->room_no === 'CA 3B')
                            <br>
                            <p>Colorado</p>
                        @elseif($cy->room_no === '313')
                            <br>
                            <p>Loft</p>
                        @elseif($cy->room_no === '509')
                            <br>
                            <p>Manors</p>
                        @endif
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
