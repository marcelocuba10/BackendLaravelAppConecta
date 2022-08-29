<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'idReference',
        'subject',
        'date'
    ];
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\NotificationsFactory::new();
    }
}
