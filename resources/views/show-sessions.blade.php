@extends('layouts.app')
@section('title', 'Active Sessions')
@section('content')
<div class="container">
    <div class="row">
        <table class="table">
        @if($active_session->count() > 0)
        <p>{{ $active_session->count() }} sessions are active.</p>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Privilege</th>
            <th>IP Address</th>
            <th>User Agent</th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($active_session as $row)
        <tr>
            <th>{{ $row_no++ }}</th>
            <td>{{ $row->name }}</th>
            <td>{{ $row->privilege }}</td>
            <td>{{ $row->ip_address }}</td>
            <td>{{ $row->user_agent }}</td>
        </tr>
        @endforeach
        @else
          <p class="text-danger">No users found.</p>
        @endif
        </table>    
    </div>
</div>
@endsection
