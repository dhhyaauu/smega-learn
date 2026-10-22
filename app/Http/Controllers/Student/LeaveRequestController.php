<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LeaveRequestController extends Controller
{
    public function index(): View
    {
        $student = Auth::user()->student;

        $leaveRequests = $student
            ? $student->leaveRequests()->orderByDesc('created_at')->get()
            : collect();

        return view('student.permission', compact('leaveRequests'));
    }

    public function store(Request $request): RedirectResponse
    {
        $student = Auth::user()->student;

        if (! $student) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Tanggal hari ini di WIB — dipakai sebagai batas minimum
        $todayWib = now()->toDateString(); // now() sudah WIB karena timezone=Asia/Jakarta

        $validated = $request->validate([
            'type'       => ['required', 'in:izin,sakit'],
            'date_start' => ['required', 'date_format:Y-m-d', 'after_or_equal:' . $todayWib],
            'date_end'   => ['required', 'date_format:Y-m-d', 'after_or_equal:date_start'],
            'reason'     => ['required', 'string', 'min:10', 'max:500'],
            'file'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'type.required'            => 'Jenis ketidakhadiran wajib dipilih.',
            'type.in'                  => 'Jenis ketidakhadiran tidak valid.',
            'date_start.required'      => 'Tanggal mulai wajib diisi.',
            'date_start.date_format'   => 'Format tanggal mulai tidak valid.',
            'date_start.after_or_equal'=> 'Tanggal mulai tidak boleh sebelum hari ini (' . now()->isoFormat('D MMMM Y') . ').',
            'date_end.required'        => 'Tanggal selesai wajib diisi.',
            'date_end.date_format'     => 'Format tanggal selesai tidak valid.',
            'date_end.after_or_equal'  => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'reason.required'          => 'Keterangan alasan wajib diisi.',
            'reason.min'               => 'Keterangan terlalu singkat, minimal 10 karakter.',
            'file.mimes'               => 'File hanya boleh berformat JPG, PNG, atau PDF.',
            'file.max'                 => 'Ukuran file maksimal 2 MB.',
        ]);

        // Cek apakah sudah ada izin yang overlap pada rentang tanggal tersebut
        $overlap = $student->leaveRequests()
            ->where('status', '!=', 'rejected')
            ->where(function ($q) use ($validated) {
                $q->whereBetween('date_start', [$validated['date_start'], $validated['date_end']])
                  ->orWhereBetween('date_end', [$validated['date_start'], $validated['date_end']])
                  ->orWhere(function ($q2) use ($validated) {
                      $q2->where('date_start', '<=', $validated['date_start'])
                         ->where('date_end', '>=', $validated['date_end']);
                  });
            })->exists();

        if ($overlap) {
            return back()
                ->withInput()
                ->with('error', 'Sudah ada pengajuan izin/sakit pada tanggal tersebut.');
        }

        // Upload surat jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('leave_requests/' . $student->id, 'local');
        }

        LeaveRequest::create([
            'student_id' => $student->id,
            'type'       => $validated['type'],
            'date_start' => $validated['date_start'],
            'date_end'   => $validated['date_end'],
            'reason'     => $validated['reason'],
            'file_path'  => $filePath,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Pengajuan izin berhasil dikirim. Tunggu konfirmasi dari guru.');
    }
}
