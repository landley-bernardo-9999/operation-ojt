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
            <th>No. </th>
            <th>Unit Owner</th>
            <th>Unit No</th>
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($owners as $owner)
        <tr>
            <td>{{ $row_no++ }}.</td>
            <td>{{ $owner->owner_first_name }} {{ $owner->owner_last_name }}</td>
            <td>{{ $owner->building }} {{ $owner->room_no }}</td>
            <td><a href="/rooms/{{ $owner->room_id }}" oncontextmenu="return false" >MORE INFO</a></td>
        </tr>
        @endforeach
        @else
       <p class="text-danger">No owners found.</p>
        @endif
    </table>    
  </div>         
</div>
@endsection
