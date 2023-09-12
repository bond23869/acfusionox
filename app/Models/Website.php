<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'website_name',
        'user_id',
        'website_url',
        'token',
        'token_expiry'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mappings()
    {
        return $this->hasMany(Mapping::class);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
