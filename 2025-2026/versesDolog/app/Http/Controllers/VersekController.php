<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kolto;
use App\Models\Versek;
use App\Models\Versszakok;

class VersekController extends Controller
{
    public function index()
    {
        //$koltok = Kolto::with("versek")->get();
        $koltok = Kolto::with("versek.versszakok")->get();
        return view("versek", compact("koltok"));
    }
}
