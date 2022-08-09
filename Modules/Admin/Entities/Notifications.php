<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'date'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\NotificationsFactory::new();
    }
}
