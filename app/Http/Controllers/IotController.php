<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datas;
class IotController extends Controller
{
    public function test_1(Request $request){


        /*{
        "test": {
            "name": "Anthony",
            "description": "Este es un proyecto abc"
        }*/

        $content = $request->getContent();

        datas::create([
            'id'=>1,
            'user_id' => 1,
            'created_at' => date("Y-m-d h:m:i"),
            'description'=> json_decode($content)->test->name
        ]);



        return response()->json(array(
            'status' => 'ok',
            'echo' => json_decode($content)->test->name
        ), 200);
    }
}
