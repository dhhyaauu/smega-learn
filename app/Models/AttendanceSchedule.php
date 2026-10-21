<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AttendanceSchedule extends Model {
    protected $fillable = ["jam_masuk","batas_terlambat","jam_pulang","is_active"];
    public static function getActive() {
        return static::where("is_active",true)->first() ?? static::create([
            "jam_masuk"=>"07:00:00","batas_terlambat"=>"07:15:00",
            "jam_pulang"=>"15:00:00","is_active"=>true
        ]);
    }
}