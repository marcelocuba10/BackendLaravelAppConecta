<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'date',
        'check_in_time',
        'check_out_time',
    ];
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\ReportsFactory::new();
    }
}
