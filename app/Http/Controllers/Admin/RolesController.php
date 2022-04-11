<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Role/Index');
    }
}
