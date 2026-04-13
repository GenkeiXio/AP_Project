<?php

namespace App\Http\Controllers\Student; // This tells Laravel it's in the Student folder

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function show()
    {
        return view('certificate'); 
    }
}