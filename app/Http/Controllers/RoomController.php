<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Gate;
use DB;
use App\Owner;
use Session;


class RoomController extends Controller
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
            if(auth()->user()->privilege === 'leasingOfficer' || auth()->user()->privilege === 'leasingManager'){

                $room = DB::table('rooms')
                ->count();

                $harvard = DB::table('rooms')
                ->where('building', 'harvard')
                ->orderBy('floor_number', 'asc')
                ->orderBy('room_no', 'asc')
                ->get();

                $princeton = DB::table('rooms')
                ->where('building', 'princeton')
                ->orderBy('floor_number', 'asc')
                ->orderBy('room_no', 'asc')
                ->get();

                $wharton = DB::table('rooms')
                ->where('building', 'wharton')
                ->orderBy('floor_number', 'asc')
                ->orderBy('room_no', 'asc')
                ->get();
    
                $cy = DB::table('rooms')
                ->where('project', 'the_courtyards')
                ->orderBy('floor_number', 'asc')
                ->orderBy('room_no', 'asc')
                ->get();
                return view('rooms', compact('room', 'harvard', 'princeton', 'wharton', 'cy'));
            }
            elseif (auth()->user()->privilege === 'billingAndCollection') {

                $s = $request->query('s');

                $rooms = DB::table('rooms')
                ->where('room_no', 'like', "%{$s}%")
                ->get();

                return view('search-rooms', compact('rooms'));
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
        return view('create-room');
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
            'room_no' => ['unique:rooms', 'nullable']
        ]);

        $room_no = request('room_no');
        $building = request('building');
        $floor_number = request('floor_number');
        $project = request('project');
        $short_term_rent = request('short_term_rent');
        $long_term_rent = request('long_term_rent');
        $transient = request('transient');
        $size = request('size');
        $no_of_beds = request('no_of_beds');

        $room = new Room();
        $room->room_no = $room_no;
        $room->building = $building;
        $room->floor_number = $floor_number;
        $room->project = $project;
        $room->short_term_rent = $short_term_rent;
        $room->long_term_rent = $long_term_rent;
        $room->transient  = $transient;
        $room->size = $size;
        $room->room_status = 'vacant';
        $room->no_of_beds = $no_of_beds;
        $room->save(); 

        return redirect('/rooms/create/')->with('success','Room is successfully created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($room_id)
    {
        try
        {
            if(auth()->user()->user_owner_id == session('owner_id') || auth()->user()->user_resident_id == session('resident_id') || auth()->user()->privilege === 'leasingOfficer'){

                $room = Room::findOrFail($room_id);

                $owner = DB::table('contracts')
                ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
                ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
                ->where('contracts.contract_room_id', $room_id)
                ->get();
        
                $resident = DB::table('transactions')
                ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
                ->where('transactions.trans_room_id', $room_id)
                ->orderBy('move_in_date', 'desc')
                ->get();
        
                if(auth()->user()->privilege === 'leasingOfficer'){
                    session(['sess_room_id' => $room->room_id]);
                    session(['sess_room_no' => $room->room_no]);
                    session(['sess_room_building' => $room->building]);
                    session(['sess_no_of_beds' => $room->no_of_beds]);
                    session(['sess_room_size' => $room->size]);
                    session(['sess_short_term_rent' => $room->short_term_rent]);
                    session(['sess_long_term_rent' => $room->long_term_rent]);

                }      
                return view('show-room', compact('room', 'owner', 'resident'));
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
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $room = Room::findOrFail($user_id);

        return view('edit-room', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $room_id)
    {
        $room = Room::findOrFail($room_id);

        $room->room_no = $request->room_no;
        $room->building = $request->building;
        $room->project = $request->project;
        $room->room_status = $request->room_status;
        $room->short_term_rent = $request->short_term_rent;
        $room->long_term_rent = $request->long_term_rent;
        $room->transient = $request->transient;
        $room->size = $request->size;
        $room->no_of_beds = $request->no_of_beds;
        $room->remarks = $request->remarks;
        
        $room->save();

        return redirect('/rooms/'.$room_id)->with('success','Room has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($room_id)
    {
        DB::table('rooms')->where('room_id', $room_id)->delete();
        
        return redirect('/rooms/')->with('success','Room has been deleted!');
    }
}
