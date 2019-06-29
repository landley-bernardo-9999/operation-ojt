<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $primaryKey = 'repair_id';

    protected $fillable = [
        'repair_trans_id'
    ];
}
