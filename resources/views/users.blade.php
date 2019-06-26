@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">    
        <h3>Enter user name</h3> 
      </div>
    </div>
    <form class="" action="/search/users" method="GET">
        <input type="text" class="form-control" style="width:20%" name="s" value="{{ Request::query('s') }}" >
    </form> 
    <br>
    <table class="table">
        @if($users->count() > 0)
        <p>{{ $users->count() }} users found.</p>
        <tr>
            <th>No. </th>
            <th>Name</th>
            <th>Email</th>
            <th>Privilege</th>
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($users as $user)
        <tr>
            <td>{{ $row_no++ }}.</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->privilege }}</td>
            <td><a href="/users/{{ $user->user_id }}">MORE INFO</a></td>
        </tr>
        @endforeach
        @else
          <p class="text-danger">No users found.</p>
        @endif
    </table>    
  </div>         
</div>
@endsection
