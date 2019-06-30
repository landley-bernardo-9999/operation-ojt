<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Resident;
use App\Room;
use DB;
use App\Charts\DashboardChart;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            if(auth()->user()->privilege === 'leasingOfficer' ){

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
                $occupancy_manors = (DB::table('rooms')->where('building', 'manors')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'manors')->count()) * 100;
                $occupancy_arkansas = (DB::table('rooms')->where('building', 'arkansas')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'arkansas')->count()) * 100;
                $occupancy_colorado = (DB::table('rooms')->where('building', 'colorado')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'colorado')->count()) * 100;
                $occupancy_loft = (DB::table('rooms')->where('building', 'loft')->where('room_status', 'occupied')->count()/DB::table('rooms')->where('building', 'loft')->count()) * 100;
                
                //bar graph
                $chart = new DashboardChart;

                $chart->labels(['Harvard', 'Princeton', 'Wharton', 'Arkansas', 'Colorado', 'Loft', 'Manors']);
                $chart->dataset('Per Building','bar', [$occupancy_harvard ,$occupancy_princeton ,$occupancy_wharton,  $occupancy_arkansas, $occupancy_colorado, $occupancy_loft, $occupancy_manors]);

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

                return view('home', compact('move_in', 'move_out', 'rooms', 'residents', 'owners',
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
            else{
                
                abort(404, "Forbidden Page.");
            }   
        }
        catch(\Exception $e)
        {
            abort(404, "Forbidden Page.");
        }

    }
}
