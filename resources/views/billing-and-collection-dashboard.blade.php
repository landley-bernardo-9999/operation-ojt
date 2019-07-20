@extends('layouts.app')
@section('title',  'Dashboard')
@section('content')
<div class="container">
    <div class="row">
       @if($increase_rate < 0)
            <h3>Collection Rate ( +{{ number_format($increase_rate,2) }} % )</h3>
       @else
            <h3>Collection Rate ( -{{ number_format($increase_rate,2) }} % )</h3>
       @endif
    </div>
     <div class="row">
        {!! $line->container() !!}
    </div>
     <div class="row">
        <h3>Delinquent Account/Building</h3>
    </div>
     <div class="row">
        {!! $chart->container() !!}
    </div>

    <h3>List of Delinquent Accounts</h3>
    <div class="row">
        <div class="col-md-3">
            <h4>Harvard</h4>
            <table class="table">
                @if($harvard_delinquent_account->count() > 0)
                <p>{{ $harvard_delinquent_account->count() }} delinquent accounts in harvard.</p>
                <tr>
                    <th>#</th>
                    <th>Resident</th>
                    <th>Unit</th>
                </tr>
                <?php $row_no = 1; ?>
                @foreach ($harvard_delinquent_account as $row)
                <tr>
                    <th>{{ $row_no++ }}</th>
                    <td><a href="residents/{{ $row->resident_id }}" oncontextmenu="return false">{{ $row->first_name}} {{ $row->last_name }}</a></td>
                    <td>{{ $row->room_no}} </td>
                </tr>
                @endforeach
                @else
                <p class="text-danger">No delinquent accounts in harvard.</p>
              @endif
            </table>
        </div>
        
         <div class="col-md-3">
            <h4>Princeton</h4>
            <table class="table">
                @if($princeton_delinquent_account->count() > 0)
                <p>{{ $princeton_delinquent_account->count() }} delinquent accounts in princeton.</p>
                <tr>
                    <th>#</th>
                    <th>Resident</th>
                    <th>Unit</th>
                  
                </tr>
                <?php $row_no = 1; ?>
                @foreach ($princeton_delinquent_account as $row)
                <tr>
                    <th>{{ $row_no++ }}</th>
                    <td><a href="residents/{{ $row->resident_id }}" oncontextmenu="return false">{{ $row->first_name}} {{ $row->last_name }}</a></td>
                    <td>{{ $row->room_no}} </td>
                </tr>
                @endforeach
                @else
                <p class="text-danger">No delinquent accounts in princeton.</p>
              @endif
            </table>
        </div>

         <div class="col-md-3">
            <h4>Wharton</h4>
            <table class="table">
                @if($wharton_delinquent_account->count() > 0)
                <p>{{ $wharton_delinquent_account->count() }} delinquent accounts in wharton.</p>
                <tr>
                    <th>#</th>
                    <th>Resident</th>
                    <th>Unit</th>
                </tr>
                <?php $row_no = 1; ?>
                @foreach ($wharton_delinquent_account as $row)
                <tr>
                    <th>{{ $row_no++ }}</th>
                    <td><a href="residents/{{ $row->resident_id }}" oncontextmenu="return false">{{ $row->first_name}} {{ $row->last_name }}</a></td>
                    <td>{{ $row->room_no}} </td>
                </tr>
                @endforeach
                @else
                <p class="text-danger">No delinquent accounts in wharton.</p>
              @endif
            </table>
        </div>

        <div class="col-md-3">
            <h4>Courtyards</h4>
            <table class="table">
                @if($cy_delinquent_account->count() > 0)
                <p>{{ $cy_delinquent_account->count() }} delinquent accounts in courtyards.</p>
                <tr>
                    <th>#</th>
                    <th>Resident</th>
                    <th>Unit</th>
                  
                </tr>
                <?php $row_no = 1; ?>
                @foreach ($cy_delinquent_account as $row)
                <tr>
                    <th>{{ $row_no++ }}</th>
                    <td><a href="residents/{{ $row->resident_id }}" oncontextmenu="return false">{{ $row->first_name}} {{ $row->last_name }}</a></td>
                    <td>{{ $row->room_no}} </td>
              
                </tr>
                @endforeach
                @else
                <p class="text-danger">No delinquent accounts in courtyards .</p>
              @endif
            </table>
        </div>
        
    </div>
</div>
{!! $chart->script() !!}
{!! $line->script() !!}
@endsection
