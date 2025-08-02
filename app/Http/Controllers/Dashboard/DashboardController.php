<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth'])
    //         //->only('index') // do it only to index function
    //         //->except('index') // do it unless the index function
    //     ;
    // }

    // Actions
    public function index()
    {
        $title = 'store';

        // return response : view , json , redirect
        // v1 :
        return view('dashboard.index', [
            'user' => "Qusay",
            'title' => $title
        ]);

        //v2 using compact function
        // $name = 'Qusay';
        // return view('dashboard', compact('name', 'title'));


        /**
         * you can use healper function to do this like function : view() or response()->view()          [[proceadurl programming]]
         *
         * or you can use the [[Facade class]]  View::make()  or Response::view()
         */
    }

    /*
    function hello($name)
    {

        // return view('dashboard.index' , ['name' => $name , 'user' => "Qusay"]);

        $isAuthenticated = false;
        if ($name == "Qusay") {
            $isAuthenticated = true;


            if ($isAuthenticated) {
                return response()->json([
                    'data' =>
                        [
                            'name' => $name,
                            'role' => "admin"
                        ]
                ]);
            } else
                return back();
        }
    }
    */


}
