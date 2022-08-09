<?php

namespace Modules\Admin\Entities;

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
        'observation'
    ];
    
    protected static function newFactory()
    {
        //return \Modules\Admin\Database\factories\MachinesFactory::new();
    }
}
