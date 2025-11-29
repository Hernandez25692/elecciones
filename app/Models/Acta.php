<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    protected $fillable = [
        'user_id',
        'mesa_id',
        'nivel',
        'archivo',
        'nacional',
        'liberal',
        'libre',
        'dc',
        'pinu',
        'nulos',
        'blancos',
        'total'
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
