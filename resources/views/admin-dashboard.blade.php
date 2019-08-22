@extends('layouts.app')
@section('title',  'Dashboard')
@section('content')
<div class="container">
    <div class="row">
        <h3>Dashboard as of {{ date("l jS \of F Y h:i:s A") }}</h3>
    </div>
    <div class="row">
         <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Registered Users</h3>
                </div>
                <div class="panel-body">
                    <h1>{{ $user }}</h1>
                    <p class="text-right"><a href="/users">MORE INFO</a></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Active Sessions</h3>
                </div>
                <div class="panel-body">
                    <h1>{{ $active_session }}</h1>
                    <p class="text-right"><a href="/active-sessions">MORE INFO</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
