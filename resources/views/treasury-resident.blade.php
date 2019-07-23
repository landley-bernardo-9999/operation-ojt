@extends('layouts.app')
@section('title', session('treasury_resident_name'))
@section('content')
<div class="container">
    @if($payment->payment_status === 'unpaid')
    <form action="/payments/{{ $payment->payment_id }}" method="post">
        @method('PATCH')
                {{ csrf_field() }}
    <div class="row">
        <div class="form-group">
            <label for="billing_date">Payment Date</label>
            <input class="form-control" name="payment_date" style="width:15%" type="date" value="{{date('Y-m-d')}}" required>
        </div>
        <div class="form-group">
            <label for="billing_date">Form of Payment</label>
            <select style="width:15%" name="form_of_payment" id="form_of_payment" class="form-control" onchange="getNewVal(this);" required>
                <option value="">Select One</option>
                <option value="cash">Cash</option>
                <option value="bank">Thru Bank</option>
                <option value="check">Thru Check</option>
            </select>
        </div>
    </div>
        <hr>
        <div class="row"  style="visibility:hidden" id="table" >
            <div class="col-md-12">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th>Particulars</th>
                        <th>Amount</th>
                        <th>OR #</th>
                        <th>AR #</th>
                        
                        <th style="visibility:hidden" id="bank_name_label">Bank Name</th>
                        <th style="visibility:hidden" id="bank_label">Thru Bank</th>
                        <th style="visibility:hidden" id="check_no_label">Check No</th>
                        <th style="visibility:hidden" id="check_label">Thru Check</th>
                        <th style="visibility:hidden" id="cash_label">Cash</th>
                        
                    </tr>
                    <tr>
                        <td><input type="text" style="width:100%" name="desc" class="form-control" value="{{ $payment->desc }}" readonly></td>
                        <td>{{ number_format($payment->amt,2) }}</td>
                        <td><input type="text" style="width:80%" name="or_number" class="form-control"></td>
                        <td><input type="text" style="width:80%" name="ar_number" class="form-control"></td>

                        <td><input type="text" style="width:80%" id="bank_name_value" name="bank_name_value" class="form-control"></td>
                        <td><input type="text" style="width:80%" id="bank_value" name="bank_value" class="form-control"></td>
                        <td><input type="text" style="width:80%" id="check_no_value" name="check_no_value" class="form-control"></td>
                        <td><input type="text" style="width:80%" id="check_value" name="check_value" class="form-control"></td>
                        <td><input type="text" style="width:80%" id="cash_value" name="cash_value" class="form-control"></td>
                    </tr>
                </table>
                <a href="#/" onclick="add_note()">Add Note</a>
                <div class="form-group" id="note" style="visibility:hidden">
                    <textarea name="note" rows="3" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <button style="visibility:hidden" id="submit" type="submit" onclick="return confirm('Are you sure you want to perform this operation? ');" class="btn-default"><i class="fas fa-check-circle"></i>&nbspSUBMIT</button>
    </form> 
    @else
        <a href=""></a>
        <p>Payment Date: <b>{{Carbon\Carbon::parse(  $payment->updated_at )->formatLocalized('%b %d %Y')}}</b></p>
        <p>Particulars: <b> {{ $payment->desc }} </b></p>
        <p>Form of Payment: <b> {{ $payment->form_of_payment }} {{ $payment->bank_name }} {{ $payment->check_no }} </b></p>
        <p>OR #: <b> {{ $payment->or_number }} </b></p>
        <p>AR #: <b> {{ $payment->ar_number }} </b></p>
        <p>Amount Received: <b> {{ number_format($payment->amt_paid,2) }} </b></p>
        <p>Note: <b> {{ $payment->note}} </b></p>

    @endif
</div>         
<script>
    function add_note(){
        document.getElementById('note').style.visibility = 'visible';
    }
    function getNewVal(item)
    {
        if( item.value === 'cash'){
                document.getElementById('table').style.visibility = 'visible';
                //labels
                document.getElementById('cash_label').style.visibility = 'visible';
                document.getElementById('bank_label').style.visibility = 'hidden';
                document.getElementById('check_label').style.visibility = 'hidden';
                //values
                document.getElementById('cash_value').style.visibility = 'visible';
                document.getElementById('bank_value').style.visibility = 'hidden';
                document.getElementById('check_value').style.visibility = 'hidden'
                //hide bank option
                document.getElementById('bank_name_label').style.visibility = 'hidden';
                document.getElementById('bank_name_value').style.visibility = 'hidden';
                //hide check option
                document.getElementById('check_no_label').style.visibility = 'hidden';
                document.getElementById('check_no_value').style.visibility = 'hidden';

                document.getElementById('submit').style.visibility = 'visible';
            }
            if( item.value === 'bank'){
                document.getElementById('table').style.visibility = 'visible';
                //labels
                document.getElementById('cash_label').style.visibility = 'hidden';
                document.getElementById('bank_label').style.visibility = 'visible';
                document.getElementById('check_label').style.visibility = 'hidden';
                document.getElementById('bank_name_label').style.visibility = 'visible';
                //values
                document.getElementById('cash_value').style.visibility = 'hidden';
                document.getElementById('bank_value').style.visibility = 'visible';
                document.getElementById('check_value').style.visibility = 'hidden';
                document.getElementById('bank_name_value').style.visibility = 'visible';
                //hide bank option
                document.getElementById('bank_name_label').style.visibility = 'visible';
                document.getElementById('bank_name_value').style.visibility = 'visible';
                //hide check option
                document.getElementById('check_no_label').style.visibility = 'hidden';
                document.getElementById('check_no_value').style.visibility = 'hidden';

                document.getElementById('submit').style.visibility = 'visible';
            }
            if( item.value === 'check'){
                document.getElementById('table').style.visibility = 'visible';
                //labels
                document.getElementById('cash_label').style.visibility = 'hidden';
                document.getElementById('bank_label').style.visibility = 'hidden';
                document.getElementById('check_label').style.visibility = 'visible';
                //values
                document.getElementById('cash_value').style.visibility = 'hidden';
                document.getElementById('bank_value').style.visibility = 'hidden';
                document.getElementById('check_value').style.visibility = 'visible';
                //hide bank option
                document.getElementById('bank_name_label').style.visibility = 'hidden';
                document.getElementById('bank_name_value').style.visibility = 'hidden';
                //hide check option
                document.getElementById('check_no_label').style.visibility = 'visible';
                document.getElementById('check_no_value').style.visibility = 'visible';

                document.getElementById('submit').style.visibility = 'visible';

            }
    }
</script>
@endsection
