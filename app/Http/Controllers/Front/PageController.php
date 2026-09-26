<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        $data['meta_title'] = 'Nagaldham Farm';
        $data['meta_description'] = 'Nagaldham Farm';
        return view('front.home', compact('data'));
    }
}
