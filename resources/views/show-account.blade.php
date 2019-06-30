@extends('layouts.app')
@section('title', 'My Account')
@section('content')
<div class="container">
    <a class="" href="{{ URL::previous() }}" oncontextmenu="return false">Back</a>
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
            <tr>
                <td> 
                    <form method="POST" action="/users/{{ $user->user_id }}">
                    @method('delete')
                    {{ csrf_field() }}
                    <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </table>    
       </div>
    </div>
</div>         
@endsection
