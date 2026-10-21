<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SchoolSetting;
use App\Models\AttendanceSchedule;
use Illuminate\Http\Request;
class SchoolSettingController extends Controller {
    public function index() {
        $setting = SchoolSetting::getSettings();
        $schedule = AttendanceSchedule::getActive();
        return view("admin.settings.index", compact("setting","schedule"));
    }
    public function updateLocation(Request $request) {
        $request->validate([
            "school_latitude"  => "required|numeric|between:-90,90",
            "school_longitude" => "required|numeric|between:-180,180",
            "radius_meter"     => "required|integer|min:10|max:1000",
            "max_accuracy"     => "required|integer|min:5|max:100",
        ]);
        $setting = SchoolSetting::getSettings();
        $setting->update($request->only(["school_latitude","school_longitude","radius_meter","max_accuracy"]));
        return redirect()->route("admin.settings")->with("success","Pengaturan lokasi berhasil disimpan!");
    }
    public function updateSchedule(Request $request) {
        $request->validate([
            "jam_masuk"       => "required|date_format:H:i",
            "batas_terlambat" => "required|date_format:H:i",
            "jam_pulang"      => "required|date_format:H:i",
        ]);
        $schedule = AttendanceSchedule::getActive();
        $schedule->update([
            "jam_masuk"       => $request->jam_masuk . ":00",
            "batas_terlambat" => $request->batas_terlambat . ":00",
            "jam_pulang"      => $request->jam_pulang . ":00",
        ]);
        return redirect()->route("admin.settings")->with("success","Jadwal presensi berhasil disimpan!");
    }
}