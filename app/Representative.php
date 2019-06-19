<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $primaryKey = 'rep_id';

    protected $fillable = [
        'rep_name',
        'rep_relationship',
        'rep_mobile_number'
    ];

    
}
