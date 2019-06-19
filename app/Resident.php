<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $primaryKey = 'resident_id';

    protected $fillable = [
            'first_name', 
            'middle_name',
            'last_name', 
            'birthdate', 
            'email_address', 
            'mobile_number',
            'telephone_number',
            'house_number', 
            'barangay', 
            'municipality', 
            'province',
            'zip', 
            'img',  
            'type_of_resident',
            'gender',
            'nationality',
            'civil_status',
            'id_info',
            'ethnicity',
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function room(){
         return $this->belongsTo(Room::class);
     }

     public function repairs(){
         return $this->hasMany(Repair::class);
     }

     public function violations(){
        return $this->hasMany(Violation::class);
    }

    public function billings(){
        return $this->hasMany(Billing::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
