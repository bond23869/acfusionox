<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingField extends Model
{
    use HasFactory;

    public function mapping()
    {
        return $this->belongsTo(Mapping::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
