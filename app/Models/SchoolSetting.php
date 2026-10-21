<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SchoolSetting extends Model {
    protected $fillable = ["school_latitude","school_longitude","radius_meter","max_accuracy"];
    public static function getSettings() {
        return static::first() ?? static::create([
            "school_latitude"=>-6.200000,"school_longitude"=>106.816666,
            "radius_meter"=>100,"max_accuracy"=>30
        ]);
    }
}