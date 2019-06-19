<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Gate;
use DB;
use App\Owner;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = DB::table('rooms')
            ->orderBy('project', 'asc')
            ->orderBy('building', 'asc')
            ->orderBy('room_no', 'asc')
            ->get();

        return view('rooms', compact('room'));
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
        $room_no = request('room_no');
        $building = request('building');
        $project = request('project');
        $short_term_rent = request('short_term_rent');
        $long_term_rent = request('long_term_rent');
        $size = request('size');
        $no_of_beds = request('no_of_beds');

        $room = new Room();
        $room->room_no = $room_no;
        $room->building = $building;
        $room->project = $project;
        $room->short_term_rent = $short_term_rent;
        $room->long_term_rent = $long_term_rent;
        $room->size = $size;
        $room->room_status = 'vacant';
        $room->no_of_beds = $no_of_beds;
        $room->save(); 

        return redirect('rooms')->with('success','Room is successfully created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($room_id)
    {
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
        ->get();

        session(['sess_room_id' => $room->room_id]);
        session(['sess_room_no' => $room->room_no]);
        session(['sess_room_building' => $room->building]);
        session(['sess_no_of_beds' => $room->no_of_beds]);

        return view('show-room', compact('room', 'owner', 'resident'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
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
