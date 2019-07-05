@extends('layouts.app')
@section('title', $user->name)
@section('content')
<div class="container">
    <h3>MY ACCOUNT</h3>   
    <br>
      <div class="row">
       <div class="col-md-8">
        <table class="table">
            <tr>
                <th>Name:</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Privilege:</th>
                <td>{{ $user->privilege }}</td>
            </tr>
            <tr>
                <td><a class="btn-default" href="/users/{{ $user->user_id }}/edit">Edit</a></td>
                <td> 
                    @if(auth()->user()->privilege === 'admin')
                        <form method="POST" action="/users/{{ $user->user_id }}">
                        @method('delete')
                        {{ csrf_field() }}
                        <button onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        </table>    
       </div>
    </div>
</div>         
@endsection
