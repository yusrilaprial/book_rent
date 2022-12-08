<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;

class RentLogController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user', 'book'])->get();
        return view('rentlog', ['rentlogs' => $rentlogs]);
    }
}
