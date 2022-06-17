<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ground extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'day',
        'schedule',
        'user_id',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'day' => 'array',
        'schedule' => 'array',
    ];

    // Mutator for Name column
    // when "name" will save, it will convert into lowercase
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    protected static function newFactory()
    {
        //return \Modules\User\Database\factories\GroundFactory::new();
    }
}
