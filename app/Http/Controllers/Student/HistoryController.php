<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(Request $request): View
    {
        $student = Auth::user()->student;

        $year  = (int) $request->query('year',  now()->year);
        $month = (int) $request->query('month', now()->month);

        $attendances = $student
            ? $student->attendances()
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->orderByDesc('date')
                ->paginate(20)
                ->withQueryString()
            : collect();

        // Rekap bulan yang sedang dilihat
        $summary = null;
        if ($student && $attendances instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $counts = $student->attendances()
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->selectRaw('status, count(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status');

            $summary = [
                'hadir'     => $counts['hadir']     ?? 0,
                'terlambat' => $counts['terlambat'] ?? 0,
                'izin'      => ($counts['izin'] ?? 0) + ($counts['sakit'] ?? 0),
                'alpa'      => $counts['alpa']      ?? 0,
            ];
        }

        // Daftar bulan untuk filter (12 bulan ke belakang)
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $m = now()->subMonths($i);
            $months[] = [
                'label'   => $m->isoFormat('MMMM Y'),
                'year'    => $m->year,
                'month'   => $m->month,
                'current' => ($m->year === $year && $m->month === $month),
            ];
        }

        return view('student.history', compact('attendances', 'summary', 'months', 'year', 'month'));
    }
}
