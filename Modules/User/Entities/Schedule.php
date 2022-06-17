<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ground_id',
        'status'
    ];
    
    protected static function newFactory()
    {
        //return \Modules\User\Database\factories\ScheduleFactory::new();
    }
}
