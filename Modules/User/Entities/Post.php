<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $fillable = [
        'title',
        'body'
    ];
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\PostFactory::new();
    }
}
