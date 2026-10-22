<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SchoolSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user    = Auth::user();
        $student = $user->student()->with('classroom')->first();

        // Presensi hari ini
        $todayAttendance = $student
            ? $student->attendances()->whereDate('date', today())->first()
            : null;

        // Rekap bulan berjalan
        $summary = null;
        if ($student) {
            $counts = $student->attendances()
                ->whereYear('date', now()->year)
                ->whereMonth('date', now()->month)
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

        // Setting sekolah (untuk info jam presensi di dashboard)
        $setting = SchoolSetting::current();

        return view('student.dashboard', compact(
            'student',
            'todayAttendance',
            'summary',
            'setting',
        ));
    }
}
