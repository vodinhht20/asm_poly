<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CopyRight extends Controller
{
    public function chinhsachbaomat(){
        return view('page.copyRight.chinh-sach-bao-mat');
    }
}
