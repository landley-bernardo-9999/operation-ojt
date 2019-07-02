@extends('layouts.app')
@section('title', $user->name)
@section('content')
<div class="container">
    <a class="" href="/users" oncontextmenu="return false">Back</a>
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
                <td><a class="btn btn-primary" href="/users/{{ $user->user_id }}/edit">Edit</a></td>
                <td> 
                    @if(auth()->user()->privilege === 'admin')
                        <form method="POST" action="/users/{{ $user->user_id }}">
                        @method('delete')
                        {{ csrf_field() }}
                        <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        </table>    
       </div>
    </div>
</div>         
@endsection
