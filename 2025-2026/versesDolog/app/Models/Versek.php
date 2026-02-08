<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kolto;
use App\Models\Versszakok;

class Versek extends Model
{
    protected $table = "versek";

    public function kolto()
    {
        return $this->belongsTo(Kolto::class, "kolto_id");
    }

    public function versszakok()
    {
        return $this->hasMany(Versszakok::class, "vers_id");
    }
}
