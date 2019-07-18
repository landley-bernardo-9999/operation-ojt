@extends('layouts.app')
@section('title', 'Owners')
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">    
        <h3>Enter owner name</h3> 
      </div>
    </div>
    <form class="" action="/search/owners" method="GET">
        <input type="text" class="form-control" style="width:20%" name="s" value="{{ Request::query('s') }}" >
    </form> 
    <br>
    <table class="table">
        @if($owners->count() > 0)
        <p>{{ $owners->count() }} owners found.</p>
        <tr>
            <th>#</th>
            <th>Unit Owner</th>
            <th>Unit No</th>
            <th>Status</th>
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($owners as $row)
        <tr>
            <th>{{ $row_no++ }}</th>
            <td>{{ $row->owner_first_name }} {{ $row->owner_last_name }}</td>
            <td>{{ $row->building }} {{ $row->room_no }}</td>
            <td>{{ $row->room_status }}</td>
            @if(auth()->user()->privilege === 'billingAndCollection')
            <td><a href="/owners/{{ $row->owner_id }}" oncontextmenu="return false">MORE INFO</a></td>
            @else
            <td><a href="/rooms/{{ $row->room_id }}" oncontextmenu="return false">MORE INFO</a></td>
            @endif
           
            <td></td>
        </tr>
        @endforeach
        @else
       <p class="text-danger">No owners found.</p>
        @endif
    </table>    
  </div>         
</div>
@endsection
