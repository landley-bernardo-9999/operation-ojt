<?php


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

Route::get('/home', 'HomeController@index');

Route::get('/', 'HomeController@index');

Auth::routes();


    Route::resources([
        'rooms' => 'RoomController',
        'residents' => 'ResidentController',
        'owners' => 'OwnerController',
        'transactions' => 'TransactionController',
        'payments' => 'PaymentController',
        'contracts' => 'ContractController',
        'users' => 'UserController',
    ]);

Route::get('/co-tenant/create', function(){
    return view('create-co-tenant');
});

Route::get('/resident/moveout', function(){
    return view('resident-moveout');
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

        session(['dashboard_owner_id'=> auth()->user()->user_owner_id]);

        return view('owner-dashboard', compact('rooms', 'enrollment_date', 'contract', 'move_out'));
    }
    if(auth()->user()->privilege === 'resident'){

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

Route::get('/search/residents{s?}', 'ResidentController@index')->where('s', '[\w\d]+');
Route::get('/search/owners{s?}', 'OwnerController@index')->where('s', '[\w\d]+');
Route::get('/search/users{s?}', 'UserController@index')->where('s', '[\w\d]+');

