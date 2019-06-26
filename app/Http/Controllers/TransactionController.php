<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Carbon;
use DB;
use App\Payment;
use App\Resident;
use App\Guardian;
use App\User;
use Hash;

class TransactionController extends Controller
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
        return view('create-resident-contract');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //get the room_id and owner_id from form
        $owner_id = $request->room_id;
        //get only the owner_id
        $pieces = explode(" ", $owner_id);

        $trans_date = $request->trans_date;
        $move_in_date = $request->move_in_date;
        $move_out_date = $request->move_out_date;
        $term = $request->term; 
        $sec_dep_rent = $request->sec_dep_rent;
        $advance_rent = $request->advance_rent;
        $sec_dep_utilities = $request->sec_dep_utilities;
        $transient = $request->transient;

        if($request->adding_room === 'yes'){
            //create the transaction.
         $transaction = new Transaction();
         $transaction->trans_date = $trans_date;
         $transaction->move_in_date = $move_in_date;
         $transaction->move_out_date = $move_out_date;
         $transaction->trans_resident_id = session('resident_id');
         $transaction->trans_room_id = $pieces[1];
         $transaction->trans_owner_id = $pieces[0];
         $transaction->trans_status = 'active';
         $transaction->term = $term;
         $transaction->save();
 
          //create the payment.
         if($sec_dep_rent > 0){
             $payment = new Payment();
             $payment->amt = $sec_dep_rent;
             $payment->desc = 'sec_dep_rent';
             $payment->payment_status = 'unpaid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->updated_at = null;
             $payment->save();
         }

         if($advance_rent > 0){
             $payment = new Payment();
             $payment->amt = $advance_rent;
             $payment->desc = 'advance_rent';
             $payment->payment_status = 'paid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->updated_at = null;
             $payment->save();
         }

         if($sec_dep_utilities > 0){
             $payment = new Payment();
             $payment->amt = $sec_dep_utilities;
             $payment->desc = 'sec_dep_utilities';
             $payment->payment_status = 'paid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->updated_at = null;
             $payment->save();
         }

         if($transient > 0){
             $payment = new Payment();
             $payment->amt = $transient;
             $payment->desc = 'transient';
             $payment->payment_status = 'paid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->updated_at = null;
             $payment->save();
         }
 
         $room = DB::table('rooms')
         ->where('room_id', session('sess_room_id'))
         ->update(['room_status' => 'occupied']);
         
        //  $room = DB::table('rooms')
        //  ->where('room_id', session('sess_room_id'))
        //  ->update(['remarks' => 'THIS IS RESERVED. RESIDENT. FULL PAYMENT HAS NOT YET BEEN SETTLED.']);

     return redirect('/residents/'.session('resident_id'))->with('success', 'Transaction has been added.');
        }else {
            //create the resident.
         $resident = new Resident();
         $resident->first_name = session('sess_first_name');
         $resident->middle_name = session('sess_middle_name');
         $resident->last_name = session('sess_last_name');
         $resident->type_of_resident = 'primary_resident';
         $resident->birthdate = session('sess_birthdate');
         $resident->nationality = session('sess_nationality');
         $resident->civil_status = session('sess_civil_status');
         $resident->id_info = session('sess_id_info');
         $resident->email_address = session('sess_email_address');
         $resident->telephone_number = session('sess_telephone_number');
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
             $user->email = session('sess_email_address');
         }
         $user->privilege = "resident";
         $user->password = Hash::make('marthaservices');
         $user->user_resident_id = $resident->resident_id;
         $user->save();

         //create the transaction.
         $transaction = new Transaction();
         $transaction->trans_date = $trans_date;
         $transaction->move_in_date = $move_in_date;
         $transaction->move_out_date = $move_out_date;
         $transaction->trans_resident_id = $resident->resident_id;
         $transaction->trans_room_id = session('sess_room_id');
         $transaction->trans_owner_id = session('sess_owner_id');
         $transaction->trans_status = 'active';
         $transaction->term = $term;
         $transaction->save();
 
          //create the payment.
         if($sec_dep_rent > 0){
             $payment = new Payment();
             $payment->amt = $sec_dep_rent;
             $payment->desc = 'sec_dep_rent';
             $payment->payment_status = 'paid';
             $payment->payment_transaction_id = $transaction->trans_id;
            //  $payment->updated_at = null;
             $payment->save();
         }

         if($advance_rent > 0){
             $payment = new Payment();
             $payment->amt = $advance_rent;
             $payment->desc = 'advance_rent';
             $payment->payment_status = 'paid';
             $payment->payment_transaction_id = $transaction->trans_id;
            //  $payment->updated_at = null;
             $payment->save();
         }

         if($sec_dep_utilities > 0){
             $payment = new Payment();
             $payment->amt = $sec_dep_utilities;
             $payment->desc = 'sec_dep_utilities';
             $payment->payment_status = 'paid';
             $payment->payment_transaction_id = $transaction->trans_id;
            //  $payment->updated_at = null;
             $payment->save();
         }

         if($transient > 0){
             $payment = new Payment();
             $payment->amt = $transient;
             $payment->desc = 'transient';
             $payment->payment_status = 'paid';
             $payment->payment_transaction_id = $transaction->trans_id;
            //  $payment->updated_at = null;
             $payment->save();
         }
 
         $room = DB::table('rooms')
         ->where('room_id', session('sess_room_id'))
         ->update(['room_status' => 'occupied']);
         
        //  $room = DB::table('rooms')
        //  ->where('room_id', session('sess_room_id'))
        //  ->update(['remarks' => 'THIS IS RESERVED. RESIDENT. FULL PAYMENT HAS NOT YET BEEN SETTLED.']);
     
         session()->forget('sess_first_name');
         session()->forget('sess_last_name');
         session()->forget('sess_middle_name');
         session()->forget('sess_birthdate');
         session()->forget('sess_email_address');
         session()->forget('sess_telephone_number');
         session()->forget('sess_mobile_number');
         session()->forget('sess_barangay');
         session()->forget('sess_municipality');
         session()->forget('sess_province');
         session()->forget('sess_zip');

         session()->forget('sess_name');
         session()->forget('sess_relationship');
         session()->forget('sess_guardian_mobile_number');

     return redirect('/rooms/'.session('sess_room_id'))->with('success', 'Resident is added to the unit.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($trans_id)
    {
        $transaction = Transaction::findOrFail($trans_id);

        $resident = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
        ->where('transactions.trans_id', $trans_id)
        ->get();

        return view('show-transaction', compact('transaction', 'resident'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($trans_id)
    {
        $transaction = Transaction::findOrFail($trans_id);

        $resident = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->where('transactions.trans_id', $trans_id)
        ->where('transactions.trans_resident_id', session('resident_id'))
        ->where('transactions.trans_room_id', session('sess_room_id'))
        ->get();

        $payment_move_ins = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
        ->where('transactions.trans_id', $trans_id)
        ->where('payments.desc','sec_dep_utilities')
        ->orWhere('payments.desc', 'sec_dep_rent')
        ->get();

        $payment_move_outs = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
        ->where('trans_id', $trans_id)
        ->where ('payments.desc','!=', 'sec_dep_utilities')
        ->where('payments.desc','!=' ,'sec_dep_rent')
        ->where('payments.desc', '!=','advance_rent')
        ->get();

        return view('resident-moveout', compact('transaction', 'resident', 'payment_move_ins', 'payment_move_outs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $trans_id)
    {
        if($request->trans_status == 'inactive'){ 
            DB::table('transactions')
                ->where('transactions.trans_resident_id', session('resident_id'))
                ->where('transactions.trans_room_id', session('sess_room_id'))
                ->update([
                            'trans_status' => 'inactive',
                            'move_out_reason' => $request->move_out_reason,
                            'actual_move_out_date' => $request->actual_move_out_date                    
                        ]);

            DB::table('transactions')
                ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                ->where('trans_room_id', session('sess_room_id'))
                    ->update([
                            'room_status' => 'vacant',
                            'remarks' => 'THE ROOM IS SET FOR GENERAL CLEANING'
                        ]);

            if($request->total_comforter > 0){
                $payment = new Payment();
                $payment->amt = $request->total_comforter;
                $payment->desc = $request->qty_comforter.'_curtain';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->total_bedlining > 0){
                $payment = new Payment();
                $payment->amt = $request->total_bedlining;
                $payment->desc = $request->qty_bedlining.'_bedlining';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }
   
            if($request->total_pillow_case > 0){
                $payment = new Payment();
                $payment->amt = $request->total_pillow_case;
                $payment->desc = $request->qty_pillow_case.'_pillow_case';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->total_pillow > 0){
                $payment = new Payment();
                $payment->amt = $request->total_pillow;
                $payment->desc = $request->qty_pillow.'_pillow';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->total_rug > 0){
                $payment = new Payment();
                $payment->amt = $request->total_rug;
                $payment->desc = $request->qty_rug.'_rug';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->total_curtain > 0){
                $payment = new Payment();
                $payment->amt = $request->total_curtain;
                $payment->desc = $request->qty_curtain.'_curtain';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->total_towel > 0){
                $payment = new Payment();
                $payment->amt = $request->total_towel;
                $payment->desc = $request->qty_towel.'_pillow_case';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->total_gc > 0){
                $payment = new Payment();
                $payment->amt = $request->total_gc;
                $payment->desc = 'general_cleaning';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            return redirect('transactions/'.$trans_id.'/edit')->with('success','Resident has moved out!');
        }
        else{
            $data = $request->all();
            Transaction::findOrFail($trans_id)->update($data);       
            
            return redirect('transactions/'.$trans_id)->with('success','Utility readings has been added!');
        }

      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
