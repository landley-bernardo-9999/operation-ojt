<?php

use App\Transaction;
use App\Resident;
use App\Room;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use App\User;
use App\Payment;
use App\Contract;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
   try{
    if(auth()->user()->privilege == null){
        return view('auth.login');
    }else{
        $user = User::findOrFail(auth()->user()->user_id);
        return view('show-account', compact('user'));      
    }
   }
   catch(\Exception $e)
   {
        return view('auth.login');
   }

});

Auth::routes();

    Route::resources([
        'rooms' => 'RoomController',
        'residents' => 'ResidentController',
        'owners' => 'OwnerController',
        'transactions' => 'TransactionController',
        'payments' => 'PaymentController',
        'contracts' => 'ContractController',
        'users' => 'UserController',
        'charges' => 'ChargesController'
    ]);

Route::get('/co-tenant/create', function(){
    return view('create-co-tenant');
});

Route::get('/resident/moveout', function(){
    return view('resident-moveout');
}); 

Route::get('/owner/remittances', function(){
    return view('owner-remittance');
}); 

Route::get('/residents/billing', function(){
    return view('billing-resident');
});  

Route::get('/owners/billing', function(){
    return view('billing-owner');
}); 

Route::get('/active-sessions', function(){

    $active_session = DB::table('users')
    ->join('sessions', 'users.user_id', 'sessions.user_id')
    ->where('sessions.user_id','!=',null)->get();
    return view('show-sessions', compact('active_session'));

}); 

Route::get('/dashboard', function(){
    if(auth()->user()->privilege === 'owner'){
        $rooms = DB::table('contracts')
        ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
        ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
        ->where('contracts.contract_owner_id', auth()->user()->user_owner_id)
        ->get();

        $enrollment_date = DB::table('contracts')
        ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
        ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
        ->where('contracts.contract_owner_id', auth()->user()->user_owner_id)
        ->orderBy('enrollment_date', 'desc')
        ->get();

        $contract = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->where('transactions.trans_owner_id', auth()->user()->user_owner_id)
        ->orderBy('move_in_date', 'desc')
        ->get();

        $move_out = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->where('transactions.trans_owner_id', auth()->user()->user_owner_id)
        ->orderBy('actual_move_out_date', 'desc')
        ->get();

        $long_term_rent = DB::table('contracts')
        ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
        ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
        ->where('contracts.contract_owner_id', auth()->user()->user_owner_id)
        ->get();

        $short_term_rent = DB::table('contracts')
        ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
        ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
        ->where('contracts.contract_owner_id', auth()->user()->user_owner_id)
        ->get();

        session(['dashboard_owner_id'=> auth()->user()->user_owner_id]);

        return view('owner-dashboard', compact('rooms', 'enrollment_date', 'contract', 'move_out', 'long_term_rent', 'short_term_rent'));
    }
    if(auth()->user()->privilege === 'admin'){
        $user = User::count();

        $active_session = DB::table('users')
        ->join('sessions', 'users.user_id', 'sessions.user_id')
        ->where('sessions.user_id','!=',null)->count();
        
        return view('admin-dashboard', compact('user', 'active_session'));
    }
    if(auth()->user()->privilege === 'treasury'){

        $collection = DB::table('transactions')
        ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
        ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
        ->select('*', 'payments.updated_at as payment_date')
        ->where('payment_status', 'paid')
        ->whereDate('payments.updated_at', Carbon::now())
        ->orderBy('payments.updated_at', 'desc')
        ->get();

        

        return view('treasury-dashboard', compact('collection'));
    } 
    if(auth()->user()->privilege === 'billingAndCollection'){

         $harvard_delinquent_account = DB::table('transactions')
                ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
                ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
                ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
                ->select('residents.*',DB::raw('sum(amt) as total'))
                ->groupBy('resident_id')
                ->whereIn('desc', ['advance_rent', 'monthly_rent'])
                ->where('payment_status', 'unpaid')
                ->where('building', 'harvard')
                ->orderBy('total', 'desc')
                ->get();

            $princeton_delinquent_account = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('residents.*',DB::raw('sum(amt) as total'))
            ->groupBy('resident_id')
            ->whereIn('desc', ['advance_rent', 'monthly_rent'])
            ->where('payment_status', 'unpaid')
            ->where('building', 'princeton')
            ->orderBy('total', 'desc')
            ->get();

            $wharton_delinquent_account = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('residents.*',DB::raw('sum(amt) as total'))
            ->groupBy('resident_id')
            ->whereIn('desc', ['advance_rent', 'monthly_rent'])
            ->where('payment_status', 'unpaid')
            ->where('building', 'wharton')
            ->orderBy('total', 'desc')
            ->get();

            $cy_delinquent_account = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('residents.*',DB::raw('sum(amt) as total'))
            ->groupBy('resident_id')
            ->whereIn('desc', ['advance_rent', 'monthly_rent'])
            ->where('payment_status', 'unpaid')
            ->where('project', 'the_courtyards')
            ->orderBy('total', 'desc')
            ->get();

              //bar graph
          $chart = new DashboardChart;

          $chart->labels(['Harvard', 'Princeton', 'Wharton', 'Courtyards']);
          $chart->dataset('','bar', [$harvard_delinquent_account->count(),
                                                 $princeton_delinquent_account->count(), 
                                                 $wharton_delinquent_account->count(),
                                                 $cy_delinquent_account->count()
                                                ]);

          //move out rate per month
            $collection_rate_past_5_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(5)->month)->whereYear('updated_at', Carbon::now()->year)->count();
            $collection_rate_past_4_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(4)->month)->whereYear('updated_at', Carbon::now()->year)->count();
            $collection_rate_past_3_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(3)->month)->whereYear('updated_at', Carbon::now()->year)->count();
            $collection_rate_past_2_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(2)->month)->whereYear('updated_at', Carbon::now()->year)->count();
            $collection_rate_past_1_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(1)->month)->whereYear('updated_at', Carbon::now()->year)->count();
            $collection_rate_present_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->month)->whereYear('updated_at', Carbon::now()->year)->count();
          //line
          $line = new DashboardChart;
          $line->labels([Carbon::now()->subMonths(5)->format('M-Y'), Carbon::now()->subMonths(4)->format('M-Y'), Carbon::now()->subMonths(3)->format('M-Y'), Carbon::now()->subMonths(2)->format('M-Y'), Carbon::now()->subMonths(1)->format('M-Y'), Carbon::now()->format('M-Y')]);
          $line->dataset('','line', [
                                                                            $collection_rate_past_5_months, 
                                                                            $collection_rate_past_4_months, 
                                                                            $collection_rate_past_3_months, 
                                                                            $collection_rate_past_2_months, 
                                                                            $collection_rate_past_1_months, 
                                                                            $collection_rate_present_months
                                                                        ]);

            $increase_rate = (($collection_rate_past_1_months - $collection_rate_present_months)/($collection_rate_past_1_months)) * 100;

        return view('billing-and-collection-dashboard', compact('harvard_delinquent_account', 'princeton_delinquent_account', 'wharton_delinquent_account', 'cy_delinquent_account', 'chart', 'line', 'increase_rate'));
    } 
    if(auth()->user()->privilege === 'resident'){

    }   
    if(auth()->user()->privilege === 'leasingOfficer'){
        $move_in = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
        ->orderBy('move_in_date', 'desc')
        ->where('trans_status', 'active')
        ->take(10)
        ->get();  

        $move_out = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->join('owners', 'transactions.trans_owner_id', 'owners.owner_id')
        ->orderBy('actual_move_out_date', 'desc')
        ->where('trans_status', 'inactive')
        ->take(10)
        ->get();    
        
        $rooms = DB::table('rooms')->count();

        $occupied_rooms_harvard = Room::where('building', 'harvard')->where('room_status', 'occupied')->count();
        $vacant_rooms_harvard = Room::where('building', 'harvard')->where('room_status', 'vacant')->count();
        $reserved_rooms_harvard = Room::where('building', 'harvard')->where('room_status', 'reserved')->count();
        $rectification_rooms_harvard = Room::where('building', 'harvard')->where('room_status', 'rectification')->count();

        $occupied_rooms_princeton= Room::where('building', 'princeton')->where('room_status', 'occupied')->count();
        $vacant_rooms_princeton = Room::where('building', 'princeton')->where('room_status', 'vacant')->count();
        $reserved_rooms_princeton = Room::where('building', 'princeton')->where('room_status', 'reserved')->count();
        $rectification_rooms_princeton = Room::where('building', 'princeton')->where('room_status', 'rectification')->count();

        $occupied_rooms_wharton =Room::where('building', 'wharton')->where('room_status', 'occupied')->count();
        $vacant_rooms_wharton = Room::where('building', 'wharton')->where('room_status', 'vacant')->count();
        $reserved_rooms_wharton = Room::where('building', 'wharton')->where('room_status', 'reserved')->count();
        $rectification_rooms_wharton = Room::where('building', 'wharton')->where('room_status', 'rectification')->count();

        $occupied_rooms_manors = Room::where('building', 'manors')->where('room_status', 'occupied')->count();
        $vacant_rooms_manors = Room::where('building', 'manors')->where('room_status', 'vacant')->count();
        $reserved_rooms_manors = Room::where('building', 'manors')->where('room_status', 'reserved')->count();
        $rectification_rooms_manors = Room::where('building', 'manors')->where('room_status', 'rectification')->count();

        $occupied_rooms_loft = Room::where('building', 'loft')->where('room_status', 'occupied')->count();
        $vacant_rooms_loft = Room::where('building', 'loft')->where('room_status', 'vacant')->count();
        $reserved_rooms_loft = Room::where('building', 'loft')->where('room_status', 'reserved')->count();
        $rectification_rooms_loft = Room::where('building', 'loft')->where('room_status', 'rectification')->count();

        $occupied_rooms_colorado = Room::where('building', 'colorado')->where('room_status', 'occupied')->count();
        $vacant_rooms_colorado = Room::where('building', 'colorado')->where('room_status', 'vacant')->count();
        $reserved_rooms_colorado = Room::where('building', 'colorado')->where('room_status', 'reserved')->count();
        $rectification_rooms_colorado = Room::where('building', 'colorado')->where('room_status', 'rectification')->count();

        $occupied_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'occupied')->count();
        $vacant_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'vacant')->count();
        $reserved_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'reserved')->count();
        $rectification_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'rectification')->count();

        $reserved_rooms = Room::where('room_status', 'reserved')->get();
        $rectification_rooms = Room::where('room_status', 'rectification')->get();

        $about_to_move_out = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->orderBy('move_out_date')
        ->where('trans_status', 'active')
        ->whereBetween('move_out_date', [
                                Carbon::now()->subYear(2), 
                                Carbon::now()->addDays(7)
                                        ])  
        ->get();  

        $harvard_least_occupied_rooms = Room::
        where('room_status', 'vacant')
        ->where('building', 'harvard')
        ->orderBy('created_at')
        ->get(); 
        
        $princeton_least_occupied_rooms = Room::
        where('room_status', 'vacant')
        ->where('building', 'princeton')
        ->orderBy('created_at')
        ->get(); 

        $wharton_least_occupied_rooms = Room::
        where('room_status', 'vacant')
        ->where('building', 'wharton')
        ->orderBy('created_at')
        ->get(); 

        $cy_least_occupied_rooms = Room::
        where('room_status', 'vacant')
        ->where('project', 'the_courtyards')
        ->orderBy('created_at')
        ->get(); 

        $nc_units_enrolled = DB::table('contracts')
                        ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
                        ->where('project', 'the_courtyards')
                        ->whereYear('enrollment_date', Carbon::now()->year)
                        ->orderBy('enrollment_date','desc')
                        ->get();

        $cy_units_enrolled = DB::table('contracts')
                        ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
                        ->where('project', 'north_cambridge')
                        ->whereYear('enrollment_date', Carbon::now()->year)
                        ->orderBy('enrollment_date', 'desc')
                        ->get();

        $occupancy_nc =  Room::where('project', 'north_cambridge')->where('room_status', 'occupied')->count() /Room::where('project', 'north_cambridge')->count() * 100;
        $occupancy_cy =  Room::where('project', 'the_courtyards')->where('room_status', 'occupied')->count() /Room::where('project', 'the_courtyards')->count() * 100;

        return view('leasing-officer-dashboard', compact('move_in', 'move_out','rooms',
            'occupied_rooms_harvard', 'vacant_rooms_harvard', 'reserved_rooms_harvard', 'rectification_rooms_harvard',
            'occupied_rooms_princeton', 'vacant_rooms_princeton', 'reserved_rooms_princeton', 'rectification_rooms_princeton',
            'occupied_rooms_wharton', 'vacant_rooms_wharton', 'reserved_rooms_wharton', 'rectification_rooms_wharton',
            'occupied_rooms_manors', 'vacant_rooms_manors', 'reserved_rooms_manors', 'rectification_rooms_manors',
            'occupied_rooms_loft', 'vacant_rooms_loft', 'reserved_rooms_loft', 'rectification_rooms_loft',
            'occupied_rooms_colorado', 'vacant_rooms_colorado', 'reserved_rooms_colorado', 'rectification_rooms_colorado',
            'occupied_rooms_arkansas', 'vacant_rooms_arkansas', 'reserved_rooms_arkansas', 'rectification_rooms_arkansas',
            'nc_rooms','cy_rooms',
            'occupancy_nc','occupancy_cy',
            'reserved_rooms','rectification_rooms',
            'about_to_move_out',
            'harvard_least_occupied_rooms','princeton_least_occupied_rooms','wharton_least_occupied_rooms','cy_least_occupied_rooms',
            'nc_units_enrolled','cy_units_enrolled'
        ));
    }  
    if(auth()->user()->privilege === 'leasingManager'){        
                $residents = Resident::where('updated_at',null)
                ->count();      
                
                $rooms =Room::count();
                $nc_rooms = Room::where('project', 'north_cambridge')->count();
                $cy_rooms = Room::where('project', 'the_courtyards')->count();
                $owners = Room::count();
        
                $occupied_rooms_harvard =Room::where('building', 'harvard')->where('room_status', 'occupied')->count();
                $vacant_rooms_harvard = Room::where('building', 'harvard')->where('room_status', 'vacant')->count();
                $reserved_rooms_harvard = Room::where('building', 'harvard')->where('room_status', 'reserved')->count();
                $rectification_rooms_harvard =Room::where('building', 'harvard')->where('room_status', 'rectification')->count();
        
                $occupied_rooms_princeton= Room::where('building', 'princeton')->where('room_status', 'occupied')->count();
                $vacant_rooms_princeton = Room::where('building', 'princeton')->where('room_status', 'vacant')->count();
                $reserved_rooms_princeton = Room::where('building', 'princeton')->where('room_status', 'reserved')->count();
                $rectification_rooms_princeton = Room::where('building', 'princeton')->where('room_status', 'rectification')->count();
        
                $occupied_rooms_wharton = Room::where('building', 'wharton')->where('room_status', 'occupied')->count();
                $vacant_rooms_wharton = Room::where('building', 'wharton')->where('room_status', 'vacant')->count();
                $reserved_rooms_wharton = Room::where('building', 'wharton')->where('room_status', 'reserved')->count();
                $rectification_rooms_wharton = Room::where('building', 'wharton')->where('room_status', 'rectification')->count();

                $occupied_rooms_manors = Room::where('building', 'manors')->where('room_status', 'occupied')->count();
                $vacant_rooms_manors = Room::where('building', 'manors')->where('room_status', 'vacant')->count();
                $reserved_rooms_manors = Room::where('building', 'manors')->where('room_status', 'reserved')->count();
                $rectification_rooms_manors = Room::where('building', 'manors')->where('room_status', 'rectification')->count();
        
                $occupied_rooms_loft = Room::where('building', 'loft')->where('room_status', 'occupied')->count();
                $vacant_rooms_loft = Room::where('building', 'loft')->where('room_status', 'vacant')->count();
                $reserved_rooms_loft = Room::where('building', 'loft')->where('room_status', 'reserved')->count();
                $rectification_rooms_loft =Room::where('building', 'loft')->where('room_status', 'rectification')->count();

                $occupied_rooms_colorado = Room::where('building', 'colorado')->where('room_status', 'occupied')->count();
                $vacant_rooms_colorado = Room::where('building', 'colorado')->where('room_status', 'vacant')->count();
                $reserved_rooms_colorado = Room::where('building', 'colorado')->where('room_status', 'reserved')->count();
                $rectification_rooms_colorado =Room::where('building', 'colorado')->where('room_status', 'rectification')->count();

                $occupied_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'occupied')->count();
                $vacant_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'vacant')->count();
                $reserved_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'reserved')->count();
                $rectification_rooms_arkansas = Room::where('building', 'arkansas')->where('room_status', 'rectification')->count();

                $reserved_rooms = Room::where('room_status', 'reserved')->get();

                //occupancy rate per site
                $occupancy_nc =  Room::where('project', 'north_cambridge')->where('room_status', 'occupied')->count() / Room::where('project', 'north_cambridge')->count() * 100;
                $occupancy_cy =  Room::where('project', 'the_courtyards')->where('room_status', 'occupied')->count() / Room::where('project', 'the_courtyards')->count() * 100;
        
                //occupancy rate per building
                $occupancy_harvard = (Room::where('building', 'harvard')->where('room_status', 'occupied')->count()/Room::where('building', 'harvard')->count()) * 100;
                $occupancy_princeton =(Room::where('building', 'princeton')->where('room_status', 'occupied')->count()/Room::where('building', 'princeton')->count()) * 100;
                $occupancy_wharton = (Room::where('building', 'wharton')->where('room_status', 'occupied')->count()/Room::where('building', 'wharton')->count()) * 100;
                $occupancy_cy =  Room::where('project', 'the_courtyards')->where('room_status', 'occupied')->count() / Room::where('project', 'the_courtyards')->count() * 100;
                
                //bar graph
                $chart = new DashboardChart;

                $chart->labels(['Harvard', 'Princeton', 'Wharton', 'Courtyards']);
                $chart->dataset('','bar', [$occupancy_harvard ,$occupancy_princeton ,$occupancy_wharton,  $occupancy_cy]);

                //move in rate per month
                
                $move_in_past_5_months = Transaction::whereMonth('move_in_date', Carbon::now()->subMonths(5)->month)->whereYear('move_in_date', Carbon::now()->year)->count();
                $move_in_past_4_months = Transaction::whereMonth('move_in_date', Carbon::now()->subMonths(4)->month)->whereYear('move_in_date', Carbon::now()->year)->count();
                $move_in_past_3_months = Transaction::whereMonth('move_in_date', Carbon::now()->subMonths(3)->month)->whereYear('move_in_date', Carbon::now()->year)->count();
                $move_in_past_2_months = Transaction::whereMonth('move_in_date', Carbon::now()->subMonths(2)->month)->whereYear('move_in_date', Carbon::now()->year)->count();
                $move_in_past_1_months = Transaction::whereMonth('move_in_date', Carbon::now()->subMonths(1)->month)->whereYear('move_in_date', Carbon::now()->year)->count();
                $move_in_present_month = Transaction::whereMonth('move_in_date', Carbon::now()->month)->whereYear('move_in_date', Carbon::now()->year)->count();


                //line
                $line = new DashboardChart;
                $line->labels([Carbon::now()->subMonths(5)->format('M-Y'), Carbon::now()->subMonths(4)->format('M-Y'), Carbon::now()->subMonths(3)->format('M-Y'), Carbon::now()->subMonths(2)->format('M-Y'), Carbon::now()->subMonths(1)->format('M-Y'), Carbon::now()->format('M-Y')]);
                $line->dataset('','line', [$move_in_past_5_months, $move_in_past_4_months, $move_in_past_3_months, $move_in_past_2_months, $move_in_past_1_months, $move_in_present_month]);

                //move out rate per month
                $move_out_past_5_months = Transaction::whereMonth('actual_move_out_date', Carbon::now()->subMonths(5)->month)->whereYear('actual_move_out_date', Carbon::now()->year)->count();
                $move_out_past_4_months = Transaction::whereMonth('actual_move_out_date', Carbon::now()->subMonths(4)->month)->whereYear('actual_move_out_date', Carbon::now()->year)->count();
                $move_out_past_3_months = Transaction::whereMonth('actual_move_out_date', Carbon::now()->subMonths(3)->month)->whereYear('actual_move_out_date', Carbon::now()->year)->count();
                $move_out_past_2_months = Transaction::whereMonth('actual_move_out_date', Carbon::now()->subMonths(2)->month)->whereYear('actual_move_out_date', Carbon::now()->year)->count();
                $move_out_past_1_months = Transaction::whereMonth('actual_move_out_date', Carbon::now()->subMonths(1)->month)->whereYear('actual_move_out_date', Carbon::now()->year)->count();
                $move_out_present_month = Transaction::whereMonth('actual_move_out_date', Carbon::now()->month)->whereYear('actual_move_out_date', Carbon::now()->year)->count();

                //line
                $line2 = new DashboardChart;
                $line2->labels([Carbon::now()->subMonths(5)->format('M-Y'), Carbon::now()->subMonths(4)->format('M-Y'), Carbon::now()->subMonths(3)->format('M-Y'), Carbon::now()->subMonths(2)->format('M-Y'), Carbon::now()->subMonths(1)->format('M-Y'), Carbon::now()->format('M-Y')]);
                $line2->dataset('','line', [$move_out_past_5_months, $move_out_past_4_months, $move_out_past_3_months, $move_out_past_2_months, $move_out_past_1_months, $move_out_present_month]);


                        //move out rate per month
                $collection_rate_past_5_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(5)->month)->whereYear('updated_at', Carbon::now()->year)->sum('mgmt_fee');
                $collection_rate_past_4_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(4)->month)->whereYear('updated_at', Carbon::now()->year)->sum('mgmt_fee');
                $collection_rate_past_3_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(3)->month)->whereYear('updated_at', Carbon::now()->year)->sum('mgmt_fee');
                $collection_rate_past_2_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(2)->month)->whereYear('updated_at', Carbon::now()->year)->sum('mgmt_fee');
                $collection_rate_past_1_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(1)->month)->whereYear('updated_at', Carbon::now()->year)->sum('mgmt_fee');
                $collection_rate_present_months = Payment::whereIn('desc', ['monthly_rent','advance_rent'])->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->month)->whereYear('updated_at', Carbon::now()->year)->sum('mgmt_fee');

                //line
                $line3 = new DashboardChart;
                $line3->labels([Carbon::now()->subMonths(5)->format('M-Y'), Carbon::now()->subMonths(4)->format('M-Y'), Carbon::now()->subMonths(3)->format('M-Y'), Carbon::now()->subMonths(2)->format('M-Y'), Carbon::now()->subMonths(1)->format('M-Y'), Carbon::now()->format('M-Y')]);
                $line3->dataset('','line', [
                                                                            $collection_rate_past_5_months, 
                                                                            $collection_rate_past_4_months, 
                                                                            $collection_rate_past_3_months, 
                                                                            $collection_rate_past_2_months, 
                                                                            $collection_rate_past_1_months, 
                                                                            $collection_rate_present_months
                                                                        ]);

            $collection_rate_increase =  (($collection_rate_past_1_months - $collection_rate_present_months)/($collection_rate_past_1_months)) * -100;

            $move_out_rate_increase = (($move_out_past_1_months - $move_out_present_month)/($move_out_past_1_months)) * 100;

            $move_in_rate_increase = (($move_in_past_1_months - $move_in_present_month)/($move_in_past_1_months)) * 100;

            $nc_units_enrolled = DB::table('contracts')
                    ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
                    ->where('project', 'the_courtyards')
                    ->whereYear('enrollment_date', Carbon::now()->year)
                    ->orderBy('enrollment_date', 'desc')
                    ->get();

            $cy_units_enrolled = DB::table('contracts')
                    ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
                    ->where('project', 'north_cambridge')
                    ->whereYear('enrollment_date', Carbon::now()->year)
                    ->orderBy('enrollment_date', 'desc')
                    ->get();

            $about_to_move_out = DB::table('transactions')
                ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
                ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
                ->select('*','transactions.updated_at as trans_updated_at')
                ->orderBy('move_out_date')
                ->where('trans_status', 'active')
                ->where('transactions.created_at', '!=' , null)
                ->get(); 

                return view('leasing-manager-dashboard', compact('move_in', 'move_out', 'rooms', 'residents', 'owners',
                    'occupied_rooms_harvard', 'vacant_rooms_harvard', 'reserved_rooms_harvard', 'rectification_rooms_harvard',
                    'occupied_rooms_princeton', 'vacant_rooms_princeton', 'reserved_rooms_princeton', 'rectification_rooms_princeton',
                    'occupied_rooms_wharton', 'vacant_rooms_wharton', 'reserved_rooms_wharton', 'rectification_rooms_wharton',
                    'occupied_rooms_manors', 'vacant_rooms_manors', 'reserved_rooms_manors', 'rectification_rooms_manors',
                    'occupied_rooms_loft', 'vacant_rooms_loft', 'reserved_rooms_loft', 'rectification_rooms_loft',
                    'occupied_rooms_colorado', 'vacant_rooms_colorado', 'reserved_rooms_colorado', 'rectification_rooms_colorado',
                    'occupied_rooms_arkansas', 'vacant_rooms_arkansas', 'reserved_rooms_arkansas', 'rectification_rooms_arkansas',
                    'nc_rooms','cy_rooms',
                    'occupancy_nc','occupancy_cy',
                    'chart', 'line', 'line2','line3','collection_rate_increase','move_in_rate_increase','move_out_rate_increase',
                    'reserved_rooms',
                    'nc_units_enrolled','cy_units_enrolled','about_to_move_out'
                ));
    }   

}); 


Route::get('/room/add', function(){
    
    $rooms = DB::table('contracts')
    ->join('owners', 'contracts.contract_owner_id', 'owners.owner_id')
    ->join('rooms', 'contracts.contract_room_id', 'rooms.room_id')
    ->orderBy('project', 'asc')
    ->orderBy('building', 'asc')
    ->orderBy('floor_number', 'asc')
    ->get();

    return view('resident-add-room', compact('rooms'));
});

Route::get('/owner/room/add', function(){

    $rooms = DB::table('contracts')
        ->rightJoin('rooms', 'contracts.contract_room_id', 'rooms.room_id')
        ->select('room_id', 'room_no', 'building', 'room_status')
        ->where('contract_id', null)
        ->orderBy('project', 'asc')
        ->orderBy('building', 'asc')
        ->orderBy('floor_number', 'asc')
        ->get(); 

    return view('owner-add-room', compact('rooms'));
});

Route::get('/search/payments{s?}', 'PaymentController@index')->where('s', '[\w\d]+');
Route::get('/search/residents{s?}', 'ResidentController@index')->where('s', '[\w\d]+');
Route::get('/search/owners{s?}', 'OwnerController@index')->where('s', '[\w\d]+');
Route::get('/search/users{s?}', 'UserController@index')->where('s', '[\w\d]+');
Route::get('/search/rooms{s?}', 'RoomController@index')->where('s', '[\w\d]+');

Route::get('/search/payments{s?}', 'PaymentController@index')->where('s', '[\w\d]+');
