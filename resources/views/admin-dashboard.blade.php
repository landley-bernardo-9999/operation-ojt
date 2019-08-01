@extends('layouts.app')
@section('title',  'Dashboard')
@section('content')
<div class="container">
    <div class="row">
         <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Registered users</h3>
                </div>
                <div class="panel-body">
                    <h1>{{ $user }}</h1>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 text-center">
            <div class="panel">
                <div class="panel-header">
                    <h3>Currently Log In</h3>
                </div>
                <div class="panel-body">
                    <h1></h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
