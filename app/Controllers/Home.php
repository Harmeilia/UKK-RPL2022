<?php

namespace App\Controllers;

use App\Models\User;
use Config\Services;
use App\Models\CatatanPerjalanan_model;

class Home extends BaseController
{
    function __construct()
    {
        Services::session();
    }

    public function index()
    {
        if (!Services::session()->get("nik")) {
            return redirect()->to(base_url('/login'));
        }

        $userdata = User::findByNIK(Services::session()->get("nik"));
        $cpdata = CatatanPerjalanan_model::get_byNIK(Services::session()->get("nik"));
        return view("index", ["userdata"=>$userdata,"cpdata"=>$cpdata]);
    }

    public function login()
    {
        if (Services::session()->get("nik")) {
            return redirect()->to(base_url('/'));
        }

        return view('login');
    }

    public function register()
    {
        if (Services::session()->get("nik")) {
            return redirect()->to(base_url('/'));
        }

        return view('register');
    }
}