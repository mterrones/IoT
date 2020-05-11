<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IotController extends Controller
{
    public function test_1(Request $request){

        $content = $request->getContent();
        $content = json_decode($content);

        return response()->json(array(
            'status' => 'ok',
            'echo' => $content
        ), 200);
    }
}
