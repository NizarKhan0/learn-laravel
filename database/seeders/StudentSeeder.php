<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     Schema::disableForeignKeyConstraints();
    //     Student::truncate();
    //     Schema::enableForeignKeyConstraints();

    //     $data = [
    //         ['name' => 'Ayu', 'gender' => 'P', 'studid' => '1234', 'class_id' => 1],
    //         ['name' => 'Siti', 'gender' => 'P', 'studid' => '1223', 'class_id' => 2],
    //         ['name' => 'Abu', 'gender' => 'L', 'studid' => '1235', 'class_id' => 3],
    //         ['name' => 'Ali', 'gender' => 'L', 'studid' => '1734', 'class_id' => 1],
    //     ];

    //         foreach ($data as $value) {
    //         Student::insert([
    //             'name' => $value['name'],
    //             'gender' => $value['gender'],
    //             'studid' => $value['studid'],
    //             'class_id' => $value['class_id'],
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now()
    //         ]);
    //     }
    // }
        public function run(): void
        {
            Student::factory()->count(10000)->create();
        }
}
