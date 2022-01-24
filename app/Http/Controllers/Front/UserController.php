<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAdmin()
    {

        return 'ahmed mofrih';
    }


    public function gitIndex(){
        // $date =[];
        // $data['id'] = 5;
        // $data['name'] = 'ahmed mofrih';
        // $obj = new \stdClass();
        // $obj -> name = 'ahmed';
        // $obj -> age = '22';
        // $obj -> id = '4';
       // return view('Welcome',compact('obj'));
     //-> with(['string'=>'ahmedmofrih','age' => '22']);
     //return view('Welcome') -> with('name','ahmed mofrih');
     $date =[];
       return view('Welcome',compact('date'));

    }
}
