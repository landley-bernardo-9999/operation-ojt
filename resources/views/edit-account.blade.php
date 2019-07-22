@extends('layouts.app')
@section('title', $user->name)
@section('content')
<div class="container">
    <a class="" href="{{ URL::previous() }}" oncontextmenu="return false">Back</a>
    <br>
    <h3>EDIT ACCOUNT</h3>   
    <br>
    <div class="row">
                    <form class="form-horizontal" method="POST" action="/users/{{ $user->user_id }}">
                        @method('PATCH')
                        {{ csrf_field() }}

                        <input type="hidden" name="user_id" value="{{ $user->user_id }}" required>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                <input type="hidden" name="user_resident_id" value={{ $user->user_resident_id }}>
                                <input type="hidden" name="user_owner_id" value={{ $user->user_owner_id }}>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Button trigger modal -->
                        <div class="form-group row">
                            <label for="password" class="col-md-8 control-label"> 
                                <a href="#/" class="change-pass" data-toggle="modal" data-target="#exampleModal">Change my password.</a>
                            </label>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default">Save</button>
                            </div>
                        </div>
                    </form>
    </div>
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form method="POST" action="/users/{{ $user->user_id }}">
                @method('PATCH')
            @csrf
            <div class="modal-body">
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}" required>  
                  <div class="form-group row">
                        <label for="" class="col-md-5">Enter your new password:</label>

                    <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        </div>
                </div>      

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-5">Confirm your new password:</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                </div>
            </div>
               
            <div class="modal-footer">
                 <button class=" btn-default" data-dismiss="modal" type="button">CANCEL</button>              
                <button class=" btn-default" onclick="return confirm('Are you sure you want to perform this operation? ');" type="submit">UPDATE</button>     
            </div>

            </form> 
    </div>
  </div>
</div>