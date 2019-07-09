@extends('layouts.app')
@section('title', 'Search')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">    
        <h3>Enter Unit No</h3> 
      </div>
    </div>
    <form class="" action="/search/payments" method="GET">
        <input type="text" class="form-control" style="width:20%" name="s" value="{{ Request::query('s') }}" >
    </form> 
    <br>
    <div class="row">
    <table class="table">
        @if($owners->count() > 0)
        <p>{{ $owners->count() }} units found.</p>
        <tr>
            <th>#</th>
            <TH>Unit Owner</TH>
            <th>Unit</th>
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($owners as $owner)
        <tr>
            <th>{{ $row_no++ }} </th>
            <td>{{ $owner->building }} {{ $owner->room_no }}</td>
            <td>{{ $owner->owner_first_name }} {{ $owner->owner_last_name }}</td>
            <td>
                <a href="/owners/{{ $owner->owner_id }}" class="">
                    MORE INFO
                </a>
            </td>
          </tr>
        @endforeach
        @else
        <p class="text-danger">No units found.</p>
      @endif
    </table>    
  </div>       
@endsection