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

                        {{-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="privilege" class="col-md-4 control-label">Privilege</label>

                            <div class="col-md-4">
                            <select class="form-control{{ $errors->has('privilege') ? ' is-invalid' : '' }}" name="privilege" id="privilege" required autofocus>
                                <option value="{{ $user->privilege }}" selected>{{ $user->privilege }}</option>
                                <option value="leasingOfficer" {{ old('privilege') == 'leasingOfficer' ? 'selected' : ''}} >Leasing Officer</option>
                                <option value="leasingManager" {{ old('privilege') == 'leasingManager' ? 'selected' : ''}}>Leasing Manager</option>
                                <option value="admin" {{ old('privilege') == 'admin' ? 'selected': ''}}>Admin</option>
                                <option value="treasury" {{ old('privilege') == 'treasury' ? 'selected': ''}}>Treasury</option>
                            </select>

                            @if ($errors->has('privilege'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('privilege') }}</strong>
                            </span>
                        @endif
                            </div>

                        </div> --}}

                        {{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                Save    
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
</div>
@endsection
