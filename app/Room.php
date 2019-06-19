<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'room_no', 
        'building', 
        'project',
        'long_term_rent', 
        'short_term_rent', 
        'rooom_status', 
        'size', 
        'no_of_beds', 
        'remarks',
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

     public function residents(){
         return $this->hasMany(Resident::class);
     }

     public function repairs(){
         return $this->hasMany(Repair::class);
     }

     public function owner(){
        return $this->belongsTo(Owner::class);
    }
}
