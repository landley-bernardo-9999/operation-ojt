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
use App\Remittance;
use Hash;
use App\Room;
use Illuminate\Support\Facades\Redirect;

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
         $transaction->trans_status = 'pending';
         $transaction->term = $term;
         $transaction->created_at = null;
         $transaction->updated_at = null;
         $transaction->save();
 
          //create the payment.
         if($sec_dep_rent > 0){
             $payment = new Payment();
             $payment->amt = $sec_dep_rent;
             $payment->desc = 'sec_dep_rent';
             $payment->payment_status = 'unpaid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->created_at = $transaction->trans_date;
             $payment->updated_at = null;
             $payment->save();
         }

         if($advance_rent > 0){
             $payment = new Payment();
             $payment->amt = $advance_rent;
             $payment->desc = 'advance_rent';
             $payment->payment_status = 'unpaid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->created_at = $transaction->trans_date;
             $payment->updated_at = null;
             $payment->save();
         }

         if($sec_dep_utilities > 0){
             $payment = new Payment();
             $payment->amt = $sec_dep_utilities;
             $payment->desc = 'sec_dep_utilities';
             $payment->payment_status = 'unpaid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->created_at = $transaction->trans_date;
             $payment->updated_at = null;
             $payment->save();
         }

         if($transient > 0){
             $payment = new Payment();
             $payment->amt = $transient;
             $payment->desc = 'transient';
             $payment->payment_status = 'unpaid';
             $payment->payment_transaction_id = $transaction->trans_id;
             $payment->created_at = $transaction->trans_date;
             $payment->updated_at = null;
             $payment->save();
         }

         $room = DB::table('rooms')
         ->where('room_id', $pieces[1])
         ->update(['room_status' => 'occupied']);
         
        //  $room = DB::table('rooms')
        //  ->where('room_id', session('sess_room_id'))
        //  ->update(['remarks' => 'THIS IS RESERVED. RESIDENT. FULL PAYMENT HAS NOT YET BEEN SETTLED.']);

     return redirect('/residents/'.session('resident_id'))->with('success', 'Transaction has been added successfully!');
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
         $resident->updated_at = null;
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
             $user->email = 'residentnoemailadress'.$resident->resident_id.'@marthaservices.com';
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
         $transaction->trans_status = 'pending';
         $transaction->term = $term;
         $transaction->created_at = null;
         $transaction->updated_at = null;
         $transaction->save();
 
          //create the payment.
         if($sec_dep_rent > 0){
            $payment = new Payment();
            $payment->amt = $sec_dep_rent;
            $payment->desc = 'sec_dep_rent';
            $payment->payment_status = 'unpaid';
            $payment->payment_transaction_id = $transaction->trans_id;
            $payment->updated_at = null;
            $payment->created_at = $transaction->trans_date;
            $payment->save();
         }

         if($advance_rent > 0){
            $payment = new Payment();
            $payment->amt = $advance_rent;
            $payment->desc = 'advance_rent';
            $payment->payment_status = 'unpaid';
            $payment->payment_transaction_id = $transaction->trans_id;
            $payment->updated_at = null;
            $payment->created_at = $transaction->trans_date;
            
            //adding remittance info for the unit owner

            if(session('sess_room_building') === 'harvard'){
                //condo dues for harvard
                $condo_dues =  session('sess_room_size') * 58.61;
                if($transaction->term === 'short_term'){
                    //management fee for harvard short-term
                    $mgmt_fee = session('sess_short_term_rent') * 0.2;
                    //remittance for the owner
                    $payment->mgmt_fee = $mgmt_fee;
                    $remittance_amt =  session('sess_short_term_rent') - ($condo_dues + $mgmt_fee);
                    $payment->condo_dues = $condo_dues;
                    $payment->others = 0;
                    $payment->remittance_amt = $remittance_amt;
                }
                elseif($transaction->term === 'long_term'){
                     //management fee for the harvard long-term
                     $mgmt_fee = 780;
                     //remittance for the owner
                     $payment->mgmt_fee = $mgmt_fee;
                     $remittance_amt =  session('sess_long_term_rent') - ($condo_dues + $mgmt_fee);
                     $payment->condo_dues = $condo_dues;
                     $payment->others = 0;
                     $payment->remittance_amt = $remittance_amt;
                }
            }
            elseif(session('sess_room_building') === 'princeton'){
                 //condo dues for princeton
                 $condo_dues =  session('sess_room_size') * 58.61;
                if($transaction->term === 'short_term'){
                     //management fee for princeton short-term
                     $mgmt_fee = 1700;
                     //remittance for the owner
                     $payment->mgmt_fee = $mgmt_fee;
                     $remittance_amt =  session('sess_short_term_rent') - ($condo_dues + $mgmt_fee);
                     $payment->condo_dues = $condo_dues;
                     $payment->others = 0;
                     $payment->remittance_amt = $remittance_amt;
                }
                elseif($transaction->term === 'long_term'){
                     //management fee for princeton long-term
                     $mgmt_fee = 1200;
                     //remittance for the owner
                     $payment->mgmt_fee = $mgmt_fee;
                     $remittance_amt =  session('sess_long_term_rent') - ($condo_dues + $mgmt_fee);
                     $payment->condo_dues = $condo_dues;
                     $payment->others = 0;
                     $payment->remittance_amt = $remittance_amt;
                }
            }
            elseif(session('sess_room_building') === 'wharton'){
                 //condo dues for wharton
                 $condo_dues =  session('sess_room_size') * 58.61;
                if($transaction->term === 'short_term'){
                    //management fee for wharton short-term
                    $mgmt_fee = session('sess_short_term_rent') * 0.2;
                    //remittance for the owner
                    $payment->mgmt_fee = $mgmt_fee;
                    $remittance_amt =  session('sess_short_term_rent') - ($condo_dues + $mgmt_fee);
                    $payment->condo_dues = $condo_dues;
                    $payment->others = 0;
                    $payment->remittance_amt = $remittance_amt;
                }
                elseif($transaction->term === 'long_term'){
                    //management fee for wharton long-term
                    $mgmt_fee = 1500;
                    //remittance for the owner
                    $payment->mgmt_fee = $mgmt_fee;
                    $remittance_amt =  session('sess_long_term_rent') - ($condo_dues + $mgmt_fee);
                    $payment->condo_dues = $condo_dues;
                    $payment->others = 0;
                    $payment->remittance_amt = $remittance_amt;
                }
            }
                    $payment->save();
            
        }

         if($sec_dep_utilities > 0){
            $payment = new Payment();
            $payment->amt = $sec_dep_utilities;
            $payment->desc = 'sec_dep_utilities';
            $payment->payment_status = 'unpaid';
            $payment->payment_transaction_id = $transaction->trans_id;
            $payment->updated_at = null;
            $payment->created_at = $transaction->trans_date;
            $payment->save();
         }

         if($transient > 0){
            $payment = new Payment();
            $payment->amt = $transient;
            $payment->desc = 'transient';
            $payment->payment_status = 'unpaid';
            $payment->payment_transaction_id = $transaction->trans_id;
            $payment->updated_at = null;
            $payment->created_at = $transaction->trans_date;
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
         session()->forget('sess_house_number');
         session()->forget('sess_barangay');
         session()->forget('sess_municipality');
         session()->forget('sess_province');
         session()->forget('sess_zip');

         session()->forget('sess_name');
         session()->forget('sess_relationship');
         session()->forget('sess_guardian_mobile_number');

     return redirect('/rooms/'.session('sess_room_id'))->with('success', 'Resident has been added to the unit.');
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
        if(auth()->user()->user_owner_id === session('owner_id') || auth()->user()->user_resident_id === session('resident_id') || auth()->user()->privilege === 'leasingOfficer'){
            
            $transaction = Transaction::findOrFail($trans_id);

            $resident = DB::table('transactions')
            ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
            ->where('transactions.trans_id', $trans_id)
            ->get();
    
            return view('show-transaction', compact('transaction', 'resident'));
        }
        else{
            abort(404, "Forbidden Page.");
        }
      
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
        ->where('transactions.trans_room_id', session('sess_room_id'))
        ->where('payment_status', 'paid')
        ->whereIn('payments.desc',['sec_dep_utilities', 'sec_dep_rent'])
        ->get();

        $payment_move_outs = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
        ->where('trans_id', $trans_id)
        ->whereNotIn ('payments.desc', ['sec_dep_utilities', 'sec_dep_rent', 'advance_rent','monthly_rent','transient'])
        ->get();

        $unpaid_charges = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
        ->where('trans_id', $trans_id)
        ->where('payment_status', 'unpaid')
        ->get();

        return view('resident-moveout', compact('transaction', 'resident', 'payment_move_ins', 'payment_move_outs', 'unpaid_charges'));
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
        $transaction = Transaction::findOrFail($trans_id);

        if(auth()->user()->privilege === 'leasingManager'){
            $transaction->updated_at = now();
            $transaction->save();

            return redirect('dashboard')->with('success','Resident move out has been approved!');
        }   

        elseif(auth()->user()->privilege === 'leasingOfficer'){
            if($request->trans_status === 'inactive' || $request->trans_status === 'pending' ){ 

                request()->validate([
                    'move_out_reason' => ['required']
                ]);
    
                //change the transaction status to inactive.
                Transaction::
                    where('transactions.trans_resident_id', session('resident_id'))
                    ->where('transactions.trans_room_id', session('sess_room_id'))
                    ->update([
                                'trans_status' => 'inactive',
                                'move_out_reason' => $request->move_out_reason,
                                'actual_move_out_date' => $request->actual_move_out_date                    
                            ]);
                       
                  //update the updated_at column of resident.     
                  Resident::
                    where('resident_id', session('resident_id'))
                 ->where('primary_resident_id', session('resident_id'))
                    ->update([
                                'updated_at' => $request->actual_move_out_date
                            ]);
                
                //update the room created_at column
                Room::
                    where('room_id', session('sess_room_id'))
                    ->update([
                                'created_at' =>  $request->actual_move_out_date  
                            ]);
    
                //change the room status to vacant.
                Room::
                    where('room_id', session('sess_room_id'))
                    ->update([
                                'room_status' => 'vacant',
                                'remarks' => 'THE ROOM IS SET FOR GENERAL CLEANING'
                            ]);
    
                $data = $request->all();
                Transaction::findOrFail($trans_id)->update($data);   
    
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
    
                if($request->total_amt > 0){
                    $payment = new Payment();
                    $payment->amt = $request->total_amt;
                    $payment->desc = 'other_charges';
                    $payment->payment_status = 'unpaid';
                    $payment->payment_transaction_id = $trans_id;
                    $payment->updated_at = null;
                    $payment->save();
                }
                return Redirect::back()->with('success', 'Resident has move out!');
            }

            elseif($transaction->trans_status === 'active' ){
                //requesting for move out to the manager.
               if($transaction->created_at == null){
                    $transaction->updated_at = null;
                    $transaction->created_at = now();
                    $transaction->save();

                    return Redirect::back()->with('success', 'Request for moveout has been sent!');

               }
               //adding and updating the utilities of the resident.
               else{
                $data = $request->all();
                Transaction::findOrFail($trans_id)->update($data);       
                
                return Redirect::back()->with('success', 'Reading for utilities has been added!');
               } 
        }
        }else{
            abort(404, "Forbidden Page.");
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
