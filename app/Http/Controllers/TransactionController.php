<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Carbon;

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

        return redirect('/payments/create')->with('success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
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
