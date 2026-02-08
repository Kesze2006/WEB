<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Versek;

class Kolto extends Model
{
    protected $table = "koltok";

    public function versek()
    {
        return $this->hasMany(Versek::class, "kolto_id");
    }
}
