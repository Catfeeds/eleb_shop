<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopRegisterController extends Controller
{
    public function index()
    {
        return view('shopRegister.index');
    }

    public function store(Request $request)
    {
        
    }

}
