@extends('layouts.app')
@section('title', $room->room_no)
@section('content')
<div class="container">
    <h3>ROOM INFORMATION</h3>    
        <br>
    <div class="row">
        <div style="margin-left: 15%">
            <form class="form-horizontal" method="POST" action="/rooms/{{ $room->room_id }}">
                @method('PATCH')
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="room_no" class="col-md-4">Room No:</label>
                    <div class="col-md-3">
                        <input name="room_no" type="text" class="form-control" value="{{ $room->room_no }}" required>
                    </div>     
                </div>

                <div class="form-group row">
                    <label for="room_status" class="col-md-4 col-form-label text-md-right">Room Status:</label>
                    <div class="col-md-3">
                        <select class="form-control" name="room_status" required>
                            <option value="{{ $room->room_status }}" selected>{{ $room->room_status }}</option>
                            <option value="occupied" >occupied</option>
                            <option value="rectification" >rectification</option>
                            <option value="reserved">reserved</option>
                            <option value="vacant">vacant</option>
                        </select>
                    </div>     
                </div>

                <div class="form-group row">
                    <label for="building" class="col-md-4 col-form-label text-md-right">Building:</label>
                    <div class="col-md-3">
                        <select class="form-control" name="building" required>
                            <option value="{{ $room->building }}" selected>{{ $room->building }}</option>
                            <option value="harvard" >Harvard</option>
                            <option value="princeton" >Princeton</option>
                            <option value="wharton">Wharton</option>
                            <option value="loft">Loft</option>
                            <option value="manors">Manors</option>
                            <option value="arkansas">Arkansas</option>
                            <option value="colorado">Colorado</option>
                        </select>
                    </div>     
                </div>

                 <div class="form-group row">
                    <label for="floor_number" class="col-md-4 col-form-label text-md-right">Floor Number:</label>
                    <div class="col-md-3">
                        <select class="form-control" name="floor_number" required>
                            <option value="{{ $room->floor_number }}" selected>{{ $room->floor_number }}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>     
                </div>

                 <div class="form-group row">
                    <label for="project" class="col-md-4 col-form-label text-md-right">Project:</label>
                    <div class="col-md-3">
                        <select class="form-control" name="project" required>
                            <option value="{{ $room->project }}" selected>{{ $room->project }}</option>
                            <option value="north_cambridge" >North Cambridge</option>
                            <option value="the_courtyards">The Courtyards</option>
                        </select>
                    </div>     
                </div>

                <div class="form-group row">
                    <label for="short_term_rent" class="col-md-4 col-form-label text-md-right">Short-term Rent:</label>
                    <div class="col-md-3">
                        <input name="short_term_rent" type="number" class="form-control" value="{{ $room->short_term_rent }}" required>
                    </div>     
                </div>

                <div class="form-group row">
                    <label for="long_term_rent" class="col-md-4 col-form-label text-md-right">Long-term Rent:</label>
                    <div class="col-md-3">
                        <input name="long_term_rent" type="number" class="form-control" value="{{ $room->long_term_rent }}" required>
                    </div>     
                </div>

                <div class="form-group row">
                    <label for="long_term_rent" class="col-md-4 col-form-label text-md-right">Transient:</label>
                    <div class="col-md-3">
                        <input name="transient" type="number" class="form-control" value="{{ $room->transient }}" required>
                    </div>     
                </div>
    
                <div class="form-group row">
                    <label for="size" class="col-md-4 col-form-label text-md-right">Size:</label>
                    <div class="col-md-3">
                        <input name="size" type="number" class="form-control" value="{{ $room->size }}" required>
                    </div>     
                </div>

                <div class="form-group row">
                    <label for="no_of_beds" class="col-md-4 col-form-label text-md-right">No Of Beds:</label>
                    <div class="col-md-3">
                        <select class="form-control" name="no_of_beds" required>
                            <option value="{{ $room->no_of_beds }}" selected>{{ $room->no_of_beds }}</option>
                            <option value="1SB">1SB</option>
                            <option value="2SB">2SB</option>
                            <option value="1DD">1DD</option>
                            <option value="2DD">2DD</option>
                            <option value="2BR">2BR </option>
                            <option value="1SB&1DD">1SB&1DD</option>
                        </select>
                    </div>     
                </div>

                <div class="form-group row">
                        <label for="remarks" class="col-md-4 col-form-label text-md-right">Remarks (if needed):</label>
                        <div class="col-md-3">
                            <textarea name="remarks" id="" cols="30" rows="10" class="form-control">
                                    {{ $room->remarks }}
                            </textarea>
                        </div>     
                </div>
              
                <a href="{{ URL::previous() }}" class="btn-default"></i>CANCEL</a>           
                <button class="btn-default" type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');">SAVE</button>         
            </form>    
        </div>
    </div> 
</div>
<br>
@endsection
