<?php

namespace App\Http\Controllers;

use App\Owner;
use Illuminate\Http\Request;
use App\Representative;
use App\Bank;
use App\Contract;
use App\User;
use Hash;
use DB;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
            if(auth()->user()->privilege === 'leasingOfficer'  || auth()->user()->privilege === 'leasingManager' ){

                $s = $request->query('s');

                $owners = DB::table('contracts')
                ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
                ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
                ->orWhere(DB::raw('CONCAT_WS(" ", owner_first_name,owner_last_name, " ")'), 'like', "%{$s}%")
                ->orWhere('owner_email_address', 'like', "%$s%")
                ->orWhere('owner_mobile_number', 'like', "%$s%")
                ->orderBy('contracts.created_at', 'desc')
                ->get();  
        
                return view ('owners', compact('owners'));
            }
            else{
                abort(404, "Forbidden Page.");
            }   
         }
        catch(\Exception $e)
        {
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
        return view('create-owner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'owner_first_name' => ['required'],
            'owner_last_name' => ['required'],
            'owner_mobile_number' => ['unique:owners','nullable'],
            'owner_email_address' => ['unique:owners', 'nullable'],
            'enrollment_date' => ['required'],
        ]);

        //create the owner.
        $owner = new Owner();
        $owner->owner_first_name = $request->owner_first_name;
        $owner->owner_last_name = $request->owner_last_name;
        $owner->owner_middle_name = $request->owner_middle_name;
        $owner->owner_birthdate = $request->owner_birthdate;
        $owner->owner_gender = $request->owner_gender;
        $owner->owner_nationality = $request->owner_nationality;
        $owner->owner_civil_status = $request->owner_civil_status;
        $owner->owner_ethnicity = $request->owner_ethnicity;
        $owner->owner_id_info = $request->owner_id_info;
        $owner->owner_email_address = $request->owner_email_address;
        $owner->owner_mobile_number = $request->owner_mobile_number;
        $owner->owner_telephone_number = $request->owner_telephone_number;
        $owner->owner_house_number = $request->owner_house_number;
        $owner->owner_barangay = $request->owner_barangay;
        $owner->owner_municipality = $request->owner_municipality;
        $owner->owner_province = $request->owner_province;
        $owner->owner_zip = $request->owner_zip;
        $owner->save();

        $user = new User();
        $user->name = $owner->owner_first_name.' '.$owner->owner_last_name;
        if($user->email = $owner->owner_email_address == null){
            $user->email = 'noemailadress'.$owner->owner_id.'@marthaservices.com';
        }else{
           $user->email = $request->owner_email_address;
        }
        $user->privilege = "owner";
        $user->password = Hash::make('marthaservices');
        $user->user_owner_id = $owner->owner_id;
        $user->save();


        //create the representative
        $rep = new Representative();
        $rep->rep_owner_id = $owner->owner_id;
        $rep->rep_name = $request->rep_name;
        $rep->rep_relationship = $request->rep_relationship;
        $rep->rep_mobile_number = $request->rep_mobile_number;
        $rep->save();

        //create the bank details.
        $bank = new Bank();
        $bank->bank_owner_id = $owner->owner_id;
        $bank->bank_name = $request->bank_name;
        $bank->bank_account_name = $request->bank_account_name;
        $bank->bank_account_number = $request->bank_account_number;
        $bank->save();

        //create the contract 
        $contract = new Contract();
        $contract->enrollment_date = $request->enrollment_date;
        $contract->contract_owner_id = $owner->owner_id;
        $contract->contract_room_id = session('sess_room_id');
        $contract->save();

        return redirect('/rooms/'.session('sess_room_id'))->with('success', 'Unit Owner is created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show($owner_id)
    {   
        try
        {
            if(auth()->user()->privilege === 'leasingOfficer' || auth()->user()->user_owner_id == $owner_id || auth()->user()->privilege === 'treasury' ){

                if( auth()->user()->privilege === 'treasury' ){
                    
                    $owner = Owner::findOrFail($owner_id);

                    $remittances = DB::table('transactions')
                    ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
                    ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
                    ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                    ->select('*', 'payments.created_at as billing_date')
                    ->where('owner_id', $owner_id)
                    ->whereIn('desc', ['monthly_rent', 'advance_rent'])
                    ->get();


                    return view('owner-remittance', compact('owner', 'remittances'));

                }else{
                    $owner = Owner::findOrFail($owner_id);

                    $owner_name = $owner->owner_first_name.' '.$owner->owner_last_name;
            
                    $owner_id = $owner->owner_id;
            
                    $bank = DB::table('banks')->where('bank_owner_id', $owner_id)->get();
            
                    $representative = DB::table('representatives')->where('rep_owner_id', $owner_id)->get();
    
                    if(auth()->user()->privilege === 'leasingOfficer' ){
                        session(['owner_name' => $owner_name]);
                        session(['owner_id' => $owner_id]);
                    }
                    
                    return view('show-owner', compact('owner', 'bank', 'representative'));
                }                
            }
            else{
                abort(404, "Forbidden Page.");
            }   
         }
        catch(\Exception $e)
        {
            abort(404, "Forbidden Page.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit($owner_id)
    {
        $owner = Owner::findOrFail($owner_id);

        $representative = Representative::where('rep_owner_id', $owner_id)->get();

        $bank = Bank::where('bank_owner_id', $owner_id)->get();

        return view('edit-owner', compact('owner', 'representative', 'bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $owner_id)
    {
        $owner = Owner::findOrFail($owner_id);

        $owner->owner_first_name = $request->owner_first_name;
        $owner->owner_last_name = $request->owner_last_name;
        $owner->owner_middle_name = $request->owner_middle_name;
        $owner->owner_birthdate = $request->owner_birthdate;
        $owner->owner_gender = $request->owner_gender;
        $owner->owner_nationality = $request->owner_nationality;
        $owner->owner_civil_status = $request->owner_civil_status;
        $owner->owner_ethnicity = $request->owner_ethnicity;
        $owner->owner_id_info = $request->owner_id_info;
        $owner->owner_email_address = $request->owner_email_address;
        $owner->owner_mobile_number = $request->owner_mobile_number;
        $owner->owner_telephone_number = $request->owner_telephone_number;
        $owner->owner_house_number = $request->owner_house_number;
        $owner->owner_barangay = $request->owner_barangay;
        $owner->owner_municipality = $request->owner_municipality;
        $owner->owner_province = $request->owner_province;
        $owner->owner_zip = $request->owner_zip;
        $owner->save();

        DB::table('representatives')
        ->where('rep_owner_id', $owner_id)
        ->update(
                [
                    'rep_name' => $request->rep_name,
                    'rep_relationship' => $request->rep_relationship,
                    'rep_mobile_number' => $request->rep_mobile_number
                ]
        );

        DB::table('banks')
        ->where('bank_owner_id', $owner_id)
        ->update(
                [
                    'bank_name' => $request->bank_name,
                    'bank_account_name' => $request->bank_account_name,
                    'bank_account_number' => $request->bank_account_number
                ]
        );

        return redirect('/owners/'.$owner_id)->with('success', 'Information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy($owner_id)
    {
        DB::table('contracts')->where('contract_owner_id', $owner_id)->delete();
        DB::table('banks')->where('bank_owner_id', $owner_id)->delete();
        DB::table('owners')->where('owner_id', $owner_id)->delete();
        DB::table('representatives')->where('rep_owner_id', $owner_id)->delete();
        DB::table('users')->where('user_owner_id', $owner_id)->delete();

        return redirect('/rooms/'.session('sess_room_id'))->with('success','Owner has been deleted!');
    }
}
