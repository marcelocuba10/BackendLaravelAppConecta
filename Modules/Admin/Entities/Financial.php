<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Financial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'exp_date_plan'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\FinancialFactory::new();
    }
}
