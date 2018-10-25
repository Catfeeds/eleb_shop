<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('public/elebshop');
        return ['url'=>Storage::url($path)];
    }
}
