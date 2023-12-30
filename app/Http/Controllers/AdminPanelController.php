<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware("auth");
//        $this->middleware("auth")->except("index");
//        $this->middleware("auth")->only("index");
//    }
    public function index()
    {
        $user="Abdelhamed ";
        return view("adminpanel.starter",["user"=>$user]);
    }
}
