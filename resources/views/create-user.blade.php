@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/users">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="privilege" class="col-md-4 control-label">Privilege</label>

                            <div class="col-md-6">
                            <select class="form-control{{ $errors->has('privilege') ? ' is-invalid' : '' }}" name="privilege" id="privilege" required autofocus>
                                <option value="" selected>Select Privilege</option>
                                <option value="leasingOfficer" {{ old('privilege') == 'leasingOfficer' ? 'selected' : ''}} >Leasing Officer</option>
                                <option value="leasingManager" {{ old('privilege') == 'leasingManager' ? 'selected' : ''}}>Leasing Manager</option>
                                <option value="admin" {{ old('privilege') == 'admin' ? 'selected': ''}}>Admin</option>
                                <option value="billingAndCollection" {{ old('billingAndCollection') == 'billingAndCollection' ? 'selected': ''}}>Billing and Collection</option>
                                <option value="treasury" {{ old('privilege') == 'treasury' ? 'selected': ''}}>Treasury</option>
                            </select>

                            @if ($errors->has('privilege'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('privilege') }}</strong>
                            </span>
                        @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default">
                                    <i class="fas fa-check-circle"></i>&nbspSubmit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
