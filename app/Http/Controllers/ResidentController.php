<?php

namespace App\Http\Controllers;

use App\Resident;
use Illuminate\Http\Request;
use DB;

class ResidentController extends Controller
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
            if(auth()->user()->privilege === 'leasingOfficer'  || auth()->user()->privilege === 'leasingManager'){

                $s = $request->query('s');

                $residents = DB::table('transactions')
                ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
                ->orWhere(DB::raw('CONCAT_WS(" ", first_name,last_name, " ")'), 'like', "%{$s}%")
                ->orWhere('email_address', 'like', "%$s%")
                ->orWhere('mobile_number', 'like', "%$s%")
                ->orderBy('trans_date', 'desc')
                ->get();  

                return view ('residents', compact('residents'));
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
        return view('create-resident');
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile_number' => ['unique:residents', 'nullable'],
            'email_address' => ['unique:residents', 'nullable'],
        ]);

        //create co-tenant
        if($request->type_of_resident == 'co_resident'){
            $resident = new Resident();
            $resident->first_name = $request->first_name;
            $resident->middle_name = $request->middle_name;
            $resident->last_name = $request->last_name;
            $resident->type_of_resident = 'co_resident';
            $resident->email_address = $request->email_address;
            $resident->mobile_number = $request->mobile_number;
            $resident->telephone_number = $request->telephone_number;
            $resident->primary_resident_id = session('resident_id');
            $resident->save();

            return redirect('/co-tenant/create')->with('success', 'Co-resident has been added!');
        }
        //create primary resident
        else{
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $middle_name = $request->middle_name;
        $birthdate = $request->birthdate;
        $gender = $request->gender;
        $nationality = $request->nationality;
        $civil_status = $request->civil_status;
        $ethnicity = $request->ethnicity;
        $id_info = $request->id_info;
        $email_address = $request->email_address;
        $mobile_number = $request->mobile_number;
        $telephone_number = $request->telephone_number;
        $house_number = $request->house_number;
        $barangay = $request->barangay;
        $municipality = $request->municipality;
        $province = $request->province;
        $zip = $request->zip;

        //resident's guardian information
        $name = $request->name;
        $relationship = $request->relationship;
        $guardian_mobile_number = $request->guardian_mobile_number;

        //place resident information in session.
        session(['sess_first_name' => $first_name]);
        session(['sess_last_name' => $last_name]);
        session(['sess_middle_name' => $middle_name]);
        session(['sess_birthdate' => $birthdate]);
        session(['sess_gender' => $gender]);
        session(['sess_nationality' => $nationality]);
        session(['sess_civil_status' => $civil_status]);
        session(['sess_ethnicity' => $ethnicity]);
        session(['sess_id_info' => $id_info]);
        session(['sess_email_address' => $email_address]);
        session(['sess_mobile_number' => $mobile_number]);
        session(['sess_telephone_number' => $telephone_number]);
        session(['sess_house_number' => $house_number]);
        session(['sess_barangay' => $barangay]);
        session(['sess_municipality' => $municipality]);
        session(['sess_province' => $province]);
        session(['sess_zip' => $zip]);

        //place resident's guardian information in session.
        session(['sess_name' => $name]);
        session(['sess_relationship' => $relationship]);
        session(['sess_guardian_mobile_number' => $guardian_mobile_number]);

        return redirect('/transactions/create')->with('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show($resident_id)
    {
        try
        {
            if(auth()->user()->privilege === 'leasingOfficer' || auth()->user()->user_resident_id == $resident_id){

                $resident = Resident::findOrFail($resident_id);

                session(['resident_name'=> $resident->first_name.' '.$resident->last_name]);
                session(['resident_id'=> $resident_id]);
        
                $contract = DB::table('transactions')
                ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
                ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
                ->where('residents.resident_id', $resident_id)
                ->orderBy('move_in_date', 'desc')
                ->get();    
        
                $guardian = DB::table('guardians')
                ->join('residents', 'guardians.guardian_resident_id', 'residents.resident_id')
                ->where('residents.resident_id', $resident_id)
                ->get(); 
        
                $co_residents = DB::table('residents')->where('primary_resident_id', $resident_id)->get();
        
                $payment = DB::table('transactions')
                ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
                ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
                ->where('residents.resident_id', $resident_id)
                ->get();
        
                return view('show-resident', compact('resident', 'contract', 'repairs', 'payment', 'co_residents', 'guardian'));
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
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resident $resident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy($resident_id)
    {
        DB::table('residents')->where('resident_id', $resident_id)->delete();
        DB::table('guardians')->where('guardian_resident_id', $resident_id)->delete();
        DB::table('transactions')->where('trans_resident_id', $resident_id)->delete();
        DB::table('users')->where('user_resident_id', $resident_id)->delete();
        DB::table('residents')->where('primary_resident_id', $resident_id)->delete();

        return redirect('/rooms/'.session('sess_room_id'))->with('success','Resident has been deleted!');
    }
}
