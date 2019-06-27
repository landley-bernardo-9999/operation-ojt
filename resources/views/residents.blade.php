@extends('layouts.app')
@section('title', 'Residents')
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">    
        <h3>Enter resident name</h3> 
      </div>
    </div>
    <form class="" action="/search/residents" method="GET">
        <input type="text" class="form-control" style="width:20%" name="s" value="{{ Request::query('s') }}" >
    </form> 
    <br>
    <table class="table">
        @if($residents->count() > 0)
        <p>{{ $residents->count() }} residents found.</p>
        <tr>
            <th>No. </th>
            <th>Resident</th>
            <th>Unit No</th>
            <th>Status</th>
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($residents as $resident)
        <tr>
            <td>{{ $row_no++ }}.</td>
            <td>{{ $resident->first_name }} {{ $resident->last_name }}</td>
            <td>{{ $resident->building }} {{ $resident->room_no }}</td>
            <td>{{ $resident->trans_status }}</td>
            <td><a href="/rooms/{{ $resident->room_id }}">MORE INFO</a></td>
        </tr>
        @endforeach
        @else
          <p class="text-danger">No residents found.</p>
        @endif
    </table>    
  </div>         
</div>
@endsection
