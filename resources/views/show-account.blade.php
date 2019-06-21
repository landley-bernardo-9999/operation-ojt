@extends('layouts.app')
@section('title', 'My Account')
@section('content')
<div class="container">
    <a class="" href="{{ URL::previous() }}">BACK</a>
    <br>
    <h3>MY ACCOUNT</h3>   
    <br>
      <div class="row">
       <div class="col-md-8">
        <table class="table">
            <tr>
                <td>Name:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $user->email }}</td>
            </tr>
        </table>    
       </div>
    </div>
</div>         
@endsection
