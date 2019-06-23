<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Carbon;
use DB;
use App\Payment;

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
        $trans_date = $request->trans_date;
        $move_in_date = $request->move_in_date;
        $move_out_date = $request->move_out_date;
        $term = $request->term;

        $secDepRent = 0;
        $advanceRent = 0;
        $transient = 0;

        session(['sess_trans_date' => $trans_date]);
        session(['sess_move_in_date' => $move_in_date]);
        session(['sess_move_out_date' => $move_out_date]);
        session(['sess_term' => $term]);

        $start=Carbon\Carbon::parse($move_in_date);
        $end=Carbon\Carbon::parse($move_out_date); 
        $durationInDays = $start->diffInDays($end);

        $building = session('sess_room_building');

        //north cambridge
        if($building == 'harvard'){
            if($term == 'long_term'){
                $secDepRent = 6800*2;
                $advanceRent = 6800;
            }
            elseif($term == 'short_term'){
                $secDepRent  = 6800;
                $advanceRent = 6800;
            }
            elseif($term == 'transient'){
                $transient = 1200 * $durationInDays;
            }
            
        }
        
        elseif($building == 'princeton'){
            if($term == 'long_term'){
                $secDepRent = 7500*2;
                $advanceRent = 7500;
            }
            elseif($term == 'short_term'){
                $secDepRent = 7500;
                $advanceRent = 7500;
            }
            elseif($term == 'transient'){
                $transient = 1200 * $durationInDays;
            }
        }
        
        elseif($building == 'wharton'){
            if($term == 'long_term'){
                $secDepRent = 11000*2;
                $advanceRent = 11000;
            }
            elseif($term == 'short_term'){
                $secDepRent = 12000;
                $advanceRent = 12000;
            }
            elseif($term == 'transient'){
                 $transient = 2000 * $durationInDays;
            }
        }

        //the courtyards
        elseif($building == 'manors'){
            if($term == 'long_term'){
                $secDepRent = 15000;
                $advanceRent = 15000;
            }
            elseif($term == 'short_term'){
                $secDepRent = 16000;
                $advanceRent = 16000;
            }
            elseif($term == 'transient'){
                 $transient = 2500 * $durationInDays;
            }
        }

            session(['sess_sec_dep_rent' => $secDepRent]);
            session(['sess_advance_rent' => $advanceRent]);

        if($term == 'transient'){
            $secDepUtilities = 0;
        }
        else{
            $secDepUtilities = 2000;
            $transient = 0;
        }

            session(['sess_transient' => $transient]);
            session(['sess_sec_dep_utilities' => $secDepUtilities]);
            
            $total = $secDepRent + $advanceRent + $secDepUtilities + $transient;

            session(['sess_total' => $total]);
            
            session(['room_id' => $request->room_id]);

        if($request->adding_room == 'yes'){
           session(['sess_adding_room' => $request->adding_room ]);
            return redirect ('/room/add/');
        }elseif($request->adding_room == 'no'){
            
            //create the transaction.
            $transaction = new Transaction();
            $transaction->trans_date = $request->trans_date;
            $transaction->move_in_date = $request->move_in_date;
            $transaction->move_out_date = $request->move_out_date;
            $transaction->trans_resident_id = session('resident_id');
            $transaction->trans_room_id =$request->room_id;
            $transaction->trans_owner_id = session('sess_owner_id');
            $transaction->trans_status = 'pending';
            $transaction->term = $request->term;
            $transaction->save();
    
             //create the payment.
            if($request->sec_dep_rent > 0){
                $payment = new Payment();
                $payment->amt = $request->sec_dep_rent;
                $payment->desc = 'sec_dep_rent';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->advance_rent > 0){
                $payment = new Payment();
                $payment->amt = $request->advance_rent;
                $payment->desc = 'advance_rent';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->sec_dep_utilities > 0){
                $payment = new Payment();
                $payment->amt = $request->sec_dep_utilities;
                $payment->desc = 'sec_dep_utilities';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }

            if($request->transient > 0){
                $payment = new Payment();
                $payment->amt = $request->transient;
                $payment->desc = 'transient';
                $payment->payment_status = 'unpaid';
                $payment->payment_transaction_id = $transaction->trans_id;
                $payment->updated_at = null;
                $payment->save();
            }
    
            $room = DB::table('rooms')
            ->where('room_id', $request->room_id)
            ->update(['room_status' => 'reserved']);
            
            $room = DB::table('rooms')
            ->where('room_id', $request->room_id)
            ->update(['remarks' => 'This room is reserved. Full payment has not yet been settled.']);

            session()->forget('sess_trans_date');
            session()->forget('sess_move_in_date');
            session()->forget('sess_move_out_date'); 
            session()->forget('sess_term');
            session()->forget('sess_adding_room');
            session()->forget('sess_sec_dep_rent');
            session()->forget('sess_sec_dep_utilities');
            session()->forget('sess_advance_rent');
            session()->forget('sess_transient');

            return redirect('/residents/'.session('resident_id'))->with('success', 'Transaction has been added!');
        }else{
            return redirect('/payments/create')->with('success');  
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
