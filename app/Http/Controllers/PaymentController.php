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
            ->whereIn('desc', ['monthly_rent', 'advance_rent'])
            ->get();
    
            return view('owner-remittance', compact('remittances'));
        } 
        elseif(auth()->user()->privilege === 'treasury'){
            $s = $request->query('s');

            $owners = DB::table('contracts')
            ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
            ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
            ->where('room_no', 'like', "%$s%")
            ->orderBy('owner_first_name', 'asc')
            ->get();  

           return view('payments', compact('owners'));
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
        //
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

        return view('show-remittance', compact('remittance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        dd('asdasasd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
