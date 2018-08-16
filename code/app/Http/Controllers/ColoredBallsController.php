<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class ColoredBallsController extends Controller
{
    public function group()
    {
        $users = DB::select('select * from test');
        return view('colored_balls');
    }
}