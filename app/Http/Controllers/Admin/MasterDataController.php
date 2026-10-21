<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MasterDataController extends Controller
{
    public function index()
    {
        return view('admin.master-data.index');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('file'));

            return back()->with('success', 'Data siswa berhasil diimpor!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal impor: ' . $e->getMessage());
        }
    }
}
