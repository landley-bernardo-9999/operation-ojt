@extends('layouts.app')
@section('title', 'Search')
@section('content')
<div class="container">

    <div class="row">
      <div class="col-md-3">    
        <h3>Enter Unit No</h3> 
      </div>
    </div>
    <form class="" action="/search/payments" method="GET">
        <input type="text" class="form-control" style="width:20%" name="s" value="{{ Request::query('s') }}" >
    </form> 
    <br>
    <div class="row">
    <table class="table">
        <tr>
            <th>#</th>
            <TH>Unit Owner</TH>
            <th>Unit</th>
            {{-- <th>Mgmt Fee</th>
            <th>Condo Dues</th>
            <th>Others</th> --}}
            <th></th>
            <?php $row_no = 1; ?>    
        </tr>   
        @foreach ($owners as $owner)
        <tr>
            <th>{{ $row_no++ }} </th>
            <td>{{ $owner->owner_first_name }} {{ $owner->owner_last_name }}</td>
            <td>{{ $owner->building }} {{ $owner->room_no }}</td>
            
            <td>
                <a href="/owners/{{ $owner->owner_id }}" class="btn-default">
                    OPEN
                </a>
            </td>
            {{-- <td><input type="text" class="" style="width:50%" value="" name="mgmt_fee"></td>
            <td><input type="text" class="" style="width:50%" value="" name="condo_dues"></td>
            <td><input type="text" class="" style="width:50%" value="" name="others"></td> --}}
            
            {{-- @if($payment->term === 'short_term')
            @if($payment->building === 'harvard')
            <th>{{  $payment->short_term_rent - (($payment->size * 58.61) + ($payment->short_term_rent * 0.2))  }} </th>
            @elseif($payment->building === 'princeton')
            <th>{{  $payment->short_term_rent - (($payment->size * 58.61) + (1700))  }} </th> 
            @elseif($payment->building === 'wharton')
            <th>{{  $payment->short_term_rent - (($payment->size * 58.61) + ($payment->short_term_rent * 0.2))  }} </th> 
            @endif
            @elseif($payment->term === 'long_term')
            @if($payment->building === 'harvard')
            <th>{{  $payment->long_term_rent - (($payment->size * 58.61) + (780))  }} </th>
            @elseif($payment->building === 'princeton')
            <th>{{  $payment->long_term_rent - (($payment->size * 58.61) + (1200))  }} </th> 
            @elseif($payment->building === 'wharton')
            <th>{{  $payment->long_term_rent - (($payment->size * 58.61) + (1500))  }} </th> 
            @endif
            @endif --}}
        
            {{-- <td><a href="payments/{{$payment->payment_id}}/">MORE INFO</a></td> --}}
        </tr>
        @endforeach
    </table>    
  </div>       

  

@endsection
{{-- <script>
    $(document).ready(function(){
        $('.show-modal').on('click', function(){
              
        });
    });
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ $owner->owner_first_name }} {{ $owner->owner_last_name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="/payments" ></form>
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>  
</div> --}}