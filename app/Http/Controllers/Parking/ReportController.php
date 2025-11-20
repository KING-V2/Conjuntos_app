<?php

namespace App\Http\Controllers\Parking;

use Illuminate\Http\Request;
use App\Models\Parking\Report;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query()->with(['client', 'vehicle']);

        if ($request->filled('start_date')) {
            $query->whereDate('invoice_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('invoice_date', '<=', $request->end_date);
        }

        $reports = $query->orderBy('invoice_date', 'desc')->get();

        return view('admin.parking.reports', compact('reports'));
    }
}
