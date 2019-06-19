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
    public function index()
    {
        //
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

            //create the resident.
            $resident = new Resident();
            $resident->first_name = session('sess_first_name');
            $resident->middle_name = session('sess_middle_name');
            $resident->last_name = session('sess_last_name');
            $resident->type_of_resident = 'primary_resident';
            $resident->birthdate = session('sess_birthdate');
            $resident->email_address = session('sess_email_address');
            $resident->mobile_number = session('sess_mobile_number');
            $resident->barangay = session('sess_barangay');
            $resident->municipality = session('sess_municipality');
            $resident->province = session('sess_province');
            $resident->zip = session('sess_zip');
            $resident->save();

            //create the guardian
            $guardian = new Guardian();
            $guardian->guardian_resident_id =$resident->resident_id;
            $guardian->name = session('sess_name');
            $guardian->relationship = session('sess_relationship');
            $guardian->mobile_number = session('sess_guardian_mobile_number');
            $guardian->save();
        
            //create the user
            $user = new User();
            $user->name = $resident->first_name.' '.$resident->last_name;
            if($user->email = $resident->email_address == null){
                $user->email = 'noemailadress'.$resident->resident_id.'@marthaservices.com';
            }else{
            $user->email = $request->email_address;
            }
            $user->privilege = "resident";
            $user->password = Hash::make('marthaservices');
            $user->user_resident_id = $resident->resident_id;
            $user->save();

            //create the transaction.
            $transaction = new Transaction();
            $transaction->trans_date = session('sess_trans_date');
            $transaction->move_in_date = session('sess_move_in_date');
            $transaction->move_out_date = session('sess_move_out_date');
            $transaction->trans_resident_id = $resident->resident_id;
            $transaction->trans_room_id = session('sess_room_id');
            $transaction->trans_owner_id = session('sess_owner_id');
            $transaction->trans_status = 'pending';
            $transaction->term = session('sess_term');
            $transaction->save();
    
             //create the payment.
            if(session('sess_sec_dep_rent') > 0){
                $payment = new Payment();
                $payment->amt = $request->sec_dep_rent;
                $payment->desc = 'sec_dep_rent';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if(session('sess_advance_rent') > 0){
                $payment = new Payment();
                $payment->amt = $request->advance_rent;
                $payment->desc = 'advance_rent';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if(session('sess_sec_dep_utilities') > 0){
                $payment = new Payment();
                $payment->amt = $request->sec_dep_utilities;
                $payment->desc = 'sec_dep_utilities';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if(session('sess_transient') > 0){
                $payment = new Payment();
                $payment->amt = $request->transient;
                $payment->desc = 'transient';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }
    
            $room = DB::table('rooms')
            ->where('room_id', session('sess_room_id'))
            ->update(['room_status' => 'reserved']);
            
            $room = DB::table('rooms')
            ->where('room_id', session('sess_room_id'))
            ->update(['remarks' => 'This room is reserved. Full payment has not yet been settled.']);
        

        return redirect('/rooms/'.session('sess_room_id'))->with('success', 'Resident has moved in!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
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
        //
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
