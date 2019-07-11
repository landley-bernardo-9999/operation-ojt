<?php

use App\Transaction;
use App\Resident;
use App\Room;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use App\User;
use App\Payment;


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

Route::get('/billings/rooms', function(){
    return view('search-rooms');
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
        return view('admin-dashboard');
    }
    if(auth()->user()->privilege === 'treasury'){
        return view('treasury-dashboard');
    } 
    if(auth()->user()->privilege === 'billingAndCollection'){

         $harvard_delinquent_account = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('*', DB::raw('sum(amt) as total'))
            ->groupBy('payment_id')
            ->havingRaw('total > 0')
            ->whereIn('desc', ['advance_rent', 'monthly_rent'])
            ->where('payment_status', 'unpaid')
            ->where('building', 'harvard')
            ->get();

         $princeton_delinquent_account = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('*', DB::raw('sum(amt) as total'))
            ->groupBy('payment_id')
            ->havingRaw('total > 0')
            ->whereIn('desc', ['advance_rent', 'monthly_rent'])
            ->where('payment_status', 'unpaid')
            ->where('building', 'princeton')
            ->get();

         $wharton_delinquent_account = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('*', DB::raw('sum(amt) as total'))
            ->groupBy('payment_id')
            ->havingRaw('total > 0')
            ->whereIn('desc', ['advance_rent', 'monthly_rent'])
            ->where('payment_status', 'unpaid')
            ->where('building', 'wharton')
            ->get();

        $cy_delinquent_account = DB::table('transactions')
            ->join('payments', 'transactions.trans_id', 'payments.payment_transaction_id')
            ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
            ->join('rooms','transactions.trans_room_id', 'rooms.room_id')
            ->select('*', DB::raw('sum(amt) as total'))
            ->groupBy('payment_id')
            ->havingRaw('total > 0')
            ->whereIn('desc', ['advance_rent', 'monthly_rent'])
            ->where('payment_status', 'unpaid')
            ->where('project', 'the_courtyards')
            ->get();

              //bar graph
          $chart = new DashboardChart;

          $chart->labels(['Harvard', 'Princeton', 'Wharton', 'Courtyards']);
          $chart->dataset('Per Building','bar', [$harvard_delinquent_account->count(),
                                                 $princeton_delinquent_account->count(), 
                                                 $wharton_delinquent_account->count(),
                                                 $cy_delinquent_account->count()
                                                ]);

          //move out rate per month
          $collection_rate_past_5_months = Payment::where('desc', 'monthly_rent')->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(5)->month)->whereYear('updated_at', Carbon::now()->year)->count();
          $collection_rate_past_4_months = Payment::where('desc', 'monthly_rent')->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(4)->month)->whereYear('updated_at', Carbon::now()->year)->count();
          $collection_rate_past_3_months = Payment::where('desc', 'monthly_rent')->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(3)->month)->whereYear('updated_at', Carbon::now()->year)->count();
          $collection_rate_past_2_months = Payment::where('desc', 'monthly_rent')->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(2)->month)->whereYear('updated_at', Carbon::now()->year)->count();
          $collection_rate_past_1_months = Payment::where('desc', 'monthly_rent')->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->subMonths(1)->month)->whereYear('updated_at', Carbon::now()->year)->count();
          $collection_rate_present_months = Payment::where('desc', 'monthly_rent')->where('payment_status', 'paid')->whereMonth('updated_at', Carbon::now()->month)->whereYear('updated_at', Carbon::now()->year)->count();

          //line
          $line = new DashboardChart;
          $line->labels([Carbon::now()->subMonths(5)->format('M-Y'), Carbon::now()->subMonths(4)->format('M-Y'), Carbon::now()->subMonths(3)->format('M-Y'), Carbon::now()->subMonths(2)->format('M-Y'), Carbon::now()->subMonths(1)->format('M-Y'), Carbon::now()->format('M-Y')]);
          $line->dataset('Collection Rate(for the last 6 months)','line', [
                                                                            $collection_rate_past_5_months, 
                                                                            $collection_rate_past_4_months, 
                                                                            $collection_rate_past_3_months, 
                                                                            $collection_rate_past_2_months, 
                                                                            $collection_rate_past_1_months, 
                                                                            $collection_rate_present_months
                                                                        ]);

        return view('billing-and-collection-dashboard', compact('harvard_delinquent_account', 'princeton_delinquent_account', 'wharton_delinquent_account', 'cy_delinquent_account', 'chart', 'line'));
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

        $residents = DB::table('transactions')
        ->leftJoin('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->where('trans_status', 'active')
        ->count();      
        
        $rooms = DB::table('rooms')->count();
        $nc_rooms = DB::table('rooms')->where('project', 'north_cambridge')->count();
        $cy_rooms = DB::table('rooms')->where('project', 'the_courtyards')->count();
        $owners = DB::table('owners')->count();

        $occupied_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'occupied')->count();
        $vacant_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'vacant')->count();
        $reserved_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'reserved')->count();
        $rectification_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'rectification')->count();

        $occupied_rooms_princeton= DB::table('rooms')->where('building', 'princeton')->where('room_status', 'occupied')->count();
        $vacant_rooms_princeton = DB::table('rooms')->where('building', 'princeton')->where('room_status', 'vacant')->count();
        $reserved_rooms_princeton = DB::table('rooms')->where('building', 'princeton')->where('room_status', 'reserved')->count();
        $rectification_rooms_princeton = DB::table('rooms')->where('building', 'princeton')->where('room_status', 'rectification')->count();

        $occupied_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'occupied')->count();
        $vacant_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'vacant')->count();
        $reserved_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'reserved')->count();
        $rectification_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'rectification')->count();

        $occupied_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'occupied')->count();
        $vacant_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'vacant')->count();
        $reserved_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'reserved')->count();
        $rectification_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'rectification')->count();

        $occupied_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'occupied')->count();
        $vacant_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'vacant')->count();
        $reserved_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'reserved')->count();
        $rectification_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'rectification')->count();

        $occupied_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'occupied')->count();
        $vacant_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'vacant')->count();
        $reserved_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'reserved')->count();
        $rectification_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'rectification')->count();

        $occupied_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'occupied')->count();
        $vacant_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'vacant')->count();
        $reserved_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'reserved')->count();
        $rectification_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'rectification')->count();

        $reserved_rooms = DB::table('rooms')->where('room_status', 'reserved')->get();
        $rectification_rooms = DB::table('rooms')->where('room_status', 'rectification')->get();

        $about_to_move_out = DB::table('transactions')
        ->join('rooms', 'transactions.trans_room_id', 'rooms.room_id')
        ->join('residents', 'transactions.trans_resident_id', 'residents.resident_id')
        ->orderBy('move_in_date', 'desc')
        ->where('trans_status', 'active')
        ->whereBetween('move_out_date', [Carbon::now(), Carbon::now()->addDays(7)])
        ->get();  


        $occupancy_nc =  DB::table('rooms')->where('project', 'north_cambridge')->where('room_status', 'occupied')->count() / DB::table('rooms')->where('project', 'north_cambridge')->count() * 100;
        $occupancy_cy =  DB::table('rooms')->where('room_status', 'occupied')->where('project', 'the_courtyards')->count() / DB::table('rooms')->where('project', 'the_courtyards')->count() * 100;

        return view('leasing-officer-dashboard', compact('move_in', 'move_out', 'rooms', 'residents', 'owners',
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
            'about_to_move_out'
        ));
    }  
    if(auth()->user()->privilege === 'leasingManager'){
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
        
                $residents = DB::table('transactions')
                ->leftJoin('residents', 'transactions.trans_resident_id', 'residents.resident_id')
                ->where('trans_status', 'active')
                ->count();      
                
                $rooms = DB::table('rooms')->count();
                $nc_rooms = DB::table('rooms')->where('project', 'north_cambridge')->count();
                $cy_rooms = DB::table('rooms')->where('project', 'the_courtyards')->count();
                $owners = DB::table('owners')->count();
        
                $occupied_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'occupied')->count();
                $vacant_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'vacant')->count();
                $reserved_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'reserved')->count();
                $rectification_rooms_harvard = DB::table('rooms')->where('building', 'harvard')->where('room_status', 'rectification')->count();
        
                $occupied_rooms_princeton= DB::table('rooms')->where('building', 'princeton')->where('room_status', 'occupied')->count();
                $vacant_rooms_princeton = DB::table('rooms')->where('building', 'princeton')->where('room_status', 'vacant')->count();
                $reserved_rooms_princeton = DB::table('rooms')->where('building', 'princeton')->where('room_status', 'reserved')->count();
                $rectification_rooms_princeton = DB::table('rooms')->where('building', 'princeton')->where('room_status', 'rectification')->count();
        
                $occupied_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'occupied')->count();
                $vacant_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'vacant')->count();
                $reserved_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'reserved')->count();
                $rectification_rooms_wharton = DB::table('rooms')->where('building', 'wharton')->where('room_status', 'rectification')->count();

                $occupied_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'occupied')->count();
                $vacant_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'vacant')->count();
                $reserved_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'reserved')->count();
                $rectification_rooms_manors = DB::table('rooms')->where('building', 'manors')->where('room_status', 'rectification')->count();
        
                $occupied_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'occupied')->count();
                $vacant_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'vacant')->count();
                $reserved_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'reserved')->count();
                $rectification_rooms_loft = DB::table('rooms')->where('building', 'loft')->where('room_status', 'rectification')->count();

                $occupied_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'occupied')->count();
                $vacant_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'vacant')->count();
                $reserved_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'reserved')->count();
                $rectification_rooms_colorado = DB::table('rooms')->where('building', 'colorado')->where('room_status', 'rectification')->count();

                $occupied_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'occupied')->count();
                $vacant_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'vacant')->count();
                $reserved_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'reserved')->count();
                $rectification_rooms_arkansas = DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'rectification')->count();

                $reserved_rooms = DB::table('rooms')->where('room_status', 'reserved')->get();


                $occupancy_nc =  DB::table('rooms')->where('project', 'north_cambridge')->where('room_status', 'occupied')->count() / DB::table('rooms')->where('project', 'north_cambridge')->count() * 100;
                $occupancy_cy =  DB::table('rooms')->where('room_status', 'occupied')->where('project', 'the_courtyards')->count() / DB::table('rooms')->where('project', 'the_courtyards')->count() * 100;
        
                //occupancy rate per building
                $occupancy_harvard = (DB::table('rooms')->where('building', 'harvard')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'harvard')->count()) * 100 * 100;
                $occupancy_princeton =(DB::table('rooms')->where('building', 'princeton')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'princeton')->count()) * 100;
                $occupancy_wharton = (DB::table('rooms')->where('building', 'wharton')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'wharton')->count()) * 100;
                $occupancy_cy = (DB::table('rooms')->where('project', 'the_courtyards')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'wharton')->count()) * 100;
                
                //bar graph
                $chart = new DashboardChart;

                $chart->labels(['Harvard', 'Princeton', 'Wharton', 'Courtyards']);
                $chart->dataset('Per Building','bar', [$occupancy_harvard ,$occupancy_princeton ,$occupancy_wharton,  $occupancy_cy]);

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
                $line->dataset('Move In Rate(for the last 6 months)','line', [$move_in_past_5_months, $move_in_past_4_months, $move_in_past_3_months, $move_in_past_2_months, $move_in_past_1_months, $move_in_present_month]);

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
                $line2->dataset('Move Out Rate(for the last 6 months)','line', [$move_out_past_5_months, $move_out_past_4_months, $move_out_past_3_months, $move_out_past_2_months, $move_out_past_1_months, $move_out_present_month]);

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
                    'chart', 'line', 'line2',
                    'reserved_rooms'
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
