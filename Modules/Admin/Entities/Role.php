<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
        'idReference'
    ];

    protected $guarded = [];
    
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\RoleFactory::new();
    }
}
