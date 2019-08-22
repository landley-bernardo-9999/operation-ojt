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
        <p>{{ $residents->count() }} transactions found.</p>
        @if(auth()->user()->privilege === 'billingAndCollection')
        <h4 class="text-right">Billed residents: {{ $billed_residents }}/{{ $active_residents }} for {{ Date('F Y') }} 
        </h4>
        @endif
        <tr>
            <th>#</th>
            <th>Resident</th>
            <th>Unit No</th>
            <th>Status</th>
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($residents as $resident)
        <tr>
            <th>{{ $row_no++ }}</th>
            <td>{{ $resident->first_name }} {{ $resident->last_name }}</td>
            <td>{{ $resident->building }} {{ $resident->room_no }}</td>
            <td>{{ $resident->trans_status }}</td>
            @if(auth()->user()->privilege === 'billingAndCollection' || auth()->user()->privilege === 'treasury')
            <td><a href="/residents/{{ $resident->resident_id }}" oncontextmenu="return false">MORE INFO</a></td>
            @else
            <td><a href="/rooms/{{ $resident->room_id }}" oncontextmenu="return false">MORE INFO</a></td>
            @endif
        </tr>
        @endforeach
        @else
          <p class="text-danger">No transactions found.</p>
        @endif
    </table>    
  </div>         
</div>
@endsection
