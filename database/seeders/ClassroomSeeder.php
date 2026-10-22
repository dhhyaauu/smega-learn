<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $classrooms = [
            ['name' => 'X RPL 1',   'grade' => 'X',   'major' => 'RPL'],
            ['name' => 'X RPL 2',   'grade' => 'X',   'major' => 'RPL'],
            ['name' => 'XI RPL 1',  'grade' => 'XI',  'major' => 'RPL'],
            ['name' => 'XI RPL 2',  'grade' => 'XI',  'major' => 'RPL'],
            ['name' => 'XII RPL 1', 'grade' => 'XII', 'major' => 'RPL'],
            ['name' => 'XII RPL 2', 'grade' => 'XII', 'major' => 'RPL'],
        ];

        foreach ($classrooms as $data) {
            Classroom::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
