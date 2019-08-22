<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Resident;
use App\Room;
use App\Transaction;
use Hash;
use DB;
use App\Guardian;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->privilege === 'owner'){
            $remittances = DB::table('transactions')
            ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
            ->select('*', 'payments.created_at as billing_date')
            ->where('owner_id', auth()->user()->user_owner_id)
            ->where('payment_status','paid')
            ->whereIn('desc', ['monthly_rent', 'advance_rent'])
            ->orderBy('payments.created_at', 'desc')
            ->get();
            
            $unit = DB::table('contracts')
            ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
            ->where('contract_owner_id',  auth()->user()->user_owner_id)
            ->get(['building','room_no']);
    
            return view('owner-remittance', compact('remittances', 'unit'));
        } 
        elseif(auth()->user()->privilege === 'billingAndCollection'){
            $s = $request->query('s');

            $owners = DB::table('contracts')
            ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
            ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
            ->where('room_no', 'like', "%$s%")
            ->orderBy('project', 'asc')
            ->orderBy('building', 'asc')
            ->orderBy('room_no', 'asc')
            ->get();  

           return view('payments', compact('owners'));
        } 
        elseif(auth()->user()->privilege === 'treasury'){

<<<<<<< HEAD
           $payment_date = $request->query('payment_date');
=======
            $payment_date = $request->query('payment_date');
>>>>>>> 2b738e2cfcf0d000d7a14610a0b2cb23d1f1f0f5
            
            $collection = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('*', 'payments.updated_at as payment_date')
            ->where('payment_status', 'paid')
            ->whereDate('payments.updated_at', "$payment_date")
            ->orderBy('payments.updated_at', 'desc')
            ->get();
    
            return view('treasury-dashboard', compact('collection'));
        }
        else{
            abort(404, "Forbidden Page.");
        } 
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-resident-payment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = new Payment();

        $payment->created_at = $request->billing_date;
        $payment->payment_transaction_id = $request->trans_id;
        $payment->desc = $request->desc;
        $payment->amt = $request->amt;
        $payment->updated_at = null;
        $payment->payment_status = 'unpaid';
        $payment->save();

        return Redirect::back()->with('success', 'Resident has been billed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($payment_id)
    {
        $remittance = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
        ->join('payments', 'transactions.trans_id', 'payment_transaction_id')
        ->select('*', 'payments.created_at as billing_date')
        ->where('payment_id', $payment_id)
        ->get();  

        return view('show-remittance', compact('remittance','remittances_owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);

        return view('treasury-resident',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $payment_id)
    {
        if(auth()->user()->privilege === 'billingAndCollection'){
            $remittance = Payment::findOrFail($payment_id);
            $remittance->mgmt_fee = $request->mgmt_fee;
            $remittance->condo_dues = $request->condo_dues;
            $remittance->others = $request->others;
            $remittance->remittance_amt =  $request->remittance_amt;
            $remittance->save();
    
            return redirect('/payments/'.$payment_id)->with('success', 'Remittance has been updated successfully!');
        }
        elseif(auth()->user()->privilege === 'treasury'){

            if($request->desc === 'sec_dep_rent'){
                DB::table('transactions')
                ->join('payments', 'transactions.trans_id','payments.payment_transaction_id')
                ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                ->where('payment_id', $payment_id)
                ->update([
                            'trans_status' => 'active',
                            'room_status' => 'occupied'
                        ]);
            }

            $payment = Payment::findOrFail($payment_id);
            $payment->payment_status = 'paid';
            $payment->note = $request->note;
            $payment->or_number = $request->or_number;
            $payment->ar_number = $request->ar_number;
            $payment->updated_at = $request->payment_date;
            $payment->form_of_payment = $request->form_of_payment;

            if($request->form_of_payment === 'cash'){
                $payment->amt_paid = $request->cash_value;
                $payment->save();
            }
            elseif($request->form_of_payment === 'bank'){
                $payment->amt_paid = $request->bank_value;
                $payment->bank_name = $request->bank_name_value;
                $payment->save();
            }
            elseif($request->form_of_payment === 'check'){
                $payment->amt_paid = $request->check_value;
                $payment->check_no = $request->check_no_value;
                $payment->save();
            }
            else{
                abort(404, "Forbidden Page.");
            }

            return Redirect::back()->with('success', 'Resident bill has been settled!');
        }
        else{
            abort(404, "Forbidden Page.");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($payment_id)
    {
        Payment::where('payment_id', $payment_id)->delete();

        return Redirect::back()->with('success', 'Bill has been deleted!');
    }
}
