<?php

namespace App\Http\Controllers\Student\Module4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Module4ViewReferencesController extends Controller
{
    /**
     * Show the Module 4 References page.
     */
    public function index()
    {
        // Points to: resources/views/Students/Module4/view_references.blade.php
        return view('Students.Module4.view_references');
    }
}