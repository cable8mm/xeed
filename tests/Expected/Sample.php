<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    public function related()
    {
        return $this->belongsTo(Related::class, 'related_id');
    }
}
