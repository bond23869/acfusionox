<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'website_id',
        'field_name',
        'field_label',
        'field_type',
        'field_meta',
        'synced_at'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function mappingFields()
    {
        return $this->hasMany(MappingField::class);
    }
}
