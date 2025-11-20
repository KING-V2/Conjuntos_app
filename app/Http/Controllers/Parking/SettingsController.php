<?php

namespace App\Http\Controllers\Parking;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.parking.settings');
    }
}
