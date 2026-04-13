<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public function index()
    {
        $modules = [
            [
                'title' => 'Module 2',
                'color' => 'blue',
                'pdf' => '/modules/Module-2-Araling-Panlipunan-10.pdf',
            ],
            [
                'title' => 'Module 3',
                'color' => 'green',
                'pdf' => '/modules/Module-3-Araling-Panlipunan-10.pdf',
            ],
            [
                'title' => 'Module 4',
                'color' => 'purple',
                'pdf' => '/modules/Module-4-Araling-Panlipunan-10.pdf',
            ],
        ];

        return view('Teachers.modules', compact('modules'));
    }
}
