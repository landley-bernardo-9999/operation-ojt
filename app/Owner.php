<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $primaryKey = 'owner_id';

    protected $fillable = [
        'owner_first_name', 
        'owner_middle_name',
        'owner_last_name', 
        'owner_birthdate', 
        'owner_gender',
        'owner_nationality',
        'owner_civil_status',
        'owner_ethnicity',
        'owner_id_info',     
        'owner_email_address', 
        'owner_mobile_number',
        'owner_house_number', 
        'owner_barangay', 
        'owner_municipality', 
        'owner_province',
        'owner_zip',
        'owner_img',
];

    public function rooms(){
        return $this->hasMany(Room::class);
    }

    public function contracts(){
        return $this->hasMany(Contract::class);
    }

    public function representatives(){
        return $this->belongsTo(Representative::class);
    }

    public function banks(){
        return $this->belongsTo(Bank::class);
    }
    
}
