<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Machines extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'codeQR',
        'customer_id',
        'user_id',
        'observation',
        'mining_power',
        'total_power'
    ];
    
    protected static function newFactory()
    {
        //return \Modules\User\Database\factories\MachinesFactory::new();
    }
}
