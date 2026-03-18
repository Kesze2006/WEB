<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Mely mezők tölthetők be tömegesen
    protected $fillable = ["role"];

    // ----- Kapcsolat a User modellel -----
    public function users()
    {
        return $this->hasMany(User::class);
        // Minden Role-hoz több user tartozhat
    }
}
