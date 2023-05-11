<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EjemploController extends Controller
{
    public function login(Request $req) {        
        if($req->method()==='GET') {
            return view("login",[]);
        }
        //$datos=validator(['name','password']);
        $usuario=$req->validate(['email'=>'required','password'=>'required']);

        if (Auth::attempt($usuario)) {
            $req->session()->regenerate();
            return redirect()->intended('ok');
        }
        echo "fallo";
    }
    
    public function loginadmin(Request $req) {        
        if($req->method()==='GET') {
            return view("login",[]);
        }
        //$datos=validator(['name','password']);
        $usuario=$req->validate(['email'=>'required','password'=>'required']);

        if (Auth::guard("admin")->attempt($usuario)) {

            $req->session()->regenerate();
            return redirect()->intended('okadmin');
        }
        echo "fallo";
    }
    public function ok() {
        return view("ok",[]);
    }
    public function okadmin() {
        return view("okadmin",[]);
    }
}
