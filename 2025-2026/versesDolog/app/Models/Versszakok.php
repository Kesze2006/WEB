<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Versek;

class Versszakok extends Model
{
    protected $table = "versszakok";

    public function versek()
    {
        return $this->belongsTo(Versek::class, "vers_id");
    }
}
