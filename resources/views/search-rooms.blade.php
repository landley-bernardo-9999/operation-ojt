@extends('layouts.app')
@section('title', 'Rooms')
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">    
        <h3>Enter Unit No</h3> 
      </div>
    </div>
    <form class="" action="/search/rooms" method="GET">
        <input type="text" class="form-control" style="width:20%" name="s" value="{{ Request::query('s') }}" >
    </form> 
    <br>
    <table class="table">
        @if($rooms->count() > 0)
        <p>{{ $rooms->count() }} units found.</p>
        <tr>
            <th>#</th>
            <th>Building</th>
            <th>Unit No</th>
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($rooms as $row)
        <tr>
            <th>{{ $row_no++ }}</th>
            <td>{{ $row->building }}</td>
            <td>{{ $row->room_no }}</td>
            <td><a href="/rooms/{{ $row->room_id }}">OPEN</a> </td>
        </tr>
        @endforeach
        @else
          <p class="text-danger">No units found.</p>
        @endif
    </table>    
  </div>         
</div>
@endsection
