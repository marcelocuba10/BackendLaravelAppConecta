<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
    ];

    protected $guard_name = 'web';
    
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\PermissionFactory::new();
    }
}
