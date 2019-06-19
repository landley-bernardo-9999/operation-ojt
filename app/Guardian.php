<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $primaryKey = 'guardian_id'; 

    protected $fillable = [
        'guardian_resident_id',
        'name', 
        'relationship', 
        'mobile_number'
    ];

    public function residents(){
        return $this->belongsTo(Resident::class);
    }

}
