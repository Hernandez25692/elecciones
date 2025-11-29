<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = ['codigo', 'centro', 'municipio', 'departamento'];

    public function actas()
    {
        return $this->hasMany(Acta::class);
    }
}
