<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datas;
use Response;
use App\User;
use Auth;

class IotController extends Controller
{
    public function test_1(Request $request){

        try{
            $autho = $request->header('Authorization');
            $temp = substr($autho, 0, 5);
            $autho = substr($autho, 6);

            $autho = base64_decode($autho);
            $pos = strpos($autho, ':');

            //$autho = 'Basic YWxiZXJ0bzpOb1JlY3VlcmRvTWlLZXk=';
            
            if(strcmp($temp,'Basic') != 0 ||  $pos == false){
                return Response::json([
                    'error' => 'Error, invalid Authorization Key format.'
                ], 402);
            }else{
                $credentials = [
                    'email' => substr($autho, 0, $pos),
                    'password' => substr($autho, $pos+1)
                ];
                
                if(\Auth::attempt($credentials)){

                    $content = $request->getContent();
                    $description =json_decode($content)->test->description;
                    $to = json_decode($content)->test->to;

                    $destination = User::where('token',$to)->get();
            
                    datas::create([
                        'user_id' => Auth::user()->id,
                        'created_at' => date("Y-m-d h:m:i"),
                        'description'=> $description,
                        'to' => $to
                    ]);


                    return response()->json(array(
                        'status' => 'ok',
                        'echo' => $to
                    ), 200);
            
                }else{
                    return Response::json([
                        'error' => 'invalid username or Key'
                    ], 401);
                }
            }
        }catch(Exception $e){
            return Response::json(array(
				'error' => true,
				'message' => $e),
				500
			);
        }
    }
}
