<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plans extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\PlansFactory::new();
    }
}
