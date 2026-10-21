<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class MasterDataController extends Controller
{
    public function index() {
        $totalSiswa = Student::count();
        return view('admin.master-data.index', compact('totalSiswa'));
    }
    public function importExcel(Request $request) {
        set_time_limit(600);
        ini_set('memory_limit', '512M');
        $request->validate(['file' => 'required|mimes:xlsx,xls|max:20480']);
        try {
            $import = new StudentsImport;
            Excel::import($import, $request->file('file'));
            $msg = 'Berhasil mengimpor ' . $import->importedCount . ' siswa.';
            if ($import->skippedCount > 0) { $msg .= ' ' . $import->skippedCount . ' data dilewati.'; }
            return redirect()->route('admin.master-data')->with('success', $msg);
        } catch (\Exception $e) {
            return redirect()->route('admin.master-data')->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}
