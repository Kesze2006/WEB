<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kolto;

class KoltoController extends Controller
{
    public function index()
    {
        $koltok = Kolto::all();
        $i = 1;
        $koltok = $koltok->map(function ($kolto) use (&$i) {
            $kolto->kep = $i . ".jpg";
            $i++;
            return $kolto;
        });
        return view("koltok", compact("koltok"));
    }
}
