@extends('layouts.app')
@section('title', session('owner_name'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>CONTRACT FOR UNIT OWNER</h3>
        </div>
        <hr>
        <div class="card-body">
         <form method="POST" action="/contracts">
            {{ csrf_field() }}
            <div class="row">
                <div class="float-right col-md-3">
                    Date of Enrollment:<input type="date" name="enrollment_date" id="" value="{{date('Y-m-d')}}" class="form-control">   
                </div>

                 <div class="col-md-3">
                     Unit No:<select class="form-control" name="room_id" id="" required>
                         <option value="">Select Unit</option>
                         @foreach ($rooms as $room)
                             <option value="{{ $room->room_id }}">{{ $room->building }} {{ $room->room_no }} </option>
                         @endforeach
                     </select>
                 </div>
            </div>
      
                <hr>
            <div class="card-footer">
                <a class="float-left btn btn-primary" href="/owners/{{session('owner_id')}}"><i class="far fa-arrow-alt-circle-left"></i>&nbspBACK</a>
                <button type="submit" class="float-right btn btn-primary"><i class="fas fa-arrow-circle-right"></i>&nbspSAVE</button>
            <br>
        </div>
        </form>
    </div>
</div>
<br>
@endsection