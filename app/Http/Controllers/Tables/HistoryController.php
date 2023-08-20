<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return view('tables.history');
    }

    public function show($id)
    {
        return view('tables.history');
    }

    public function create()
    {
        return view('tables.history');
    }

    public function store(Request $request)
    {
        return view('tables.history');
    }
}
