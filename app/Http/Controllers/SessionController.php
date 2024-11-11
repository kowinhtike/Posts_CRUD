<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function theme(){
        $theme = session('theme',"light-mode");
        return $theme;
    }

    public function setTheme($value){
        session(['theme' => $value]);
        return "set theme successful!";
    }

    public function removeTheme(){
        session()->forget('theme');
        return "removed theme successful!";
    }

    public function checkTheme(){
        $themeState = session()->has('theme');
        if($themeState){
            return "yes";
        }else{
            return "no";
        }
    }


}
