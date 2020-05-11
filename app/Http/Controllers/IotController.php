<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IotController extends Controller
{
    public function test_1(){

        return response()->json(array(
            'status' => 'ok'
        ), 200);
    }
}
