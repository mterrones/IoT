<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datas;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $token=User::where('id',Auth::user()->id)->first()->token;

        $datas = datas::where('user_id',Auth::user()->id)->get();

        return view('home',[
            'token'=>$token,
            'datas'=>$datas
        ]);
    }

    public function newToken(){
        $token = $this->generateRandomString(10);

        User::where('id',Auth::user()->id)
        ->update([
            'token'=>$token
        ]);

        $datas = datas::where('user_id',Auth::user()->id)->get();

        return back();
    }

    private function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
