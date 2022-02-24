<?php

use App\Grade;
use App\RawRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en'=> 'First grade', 'ar'=> 'الصف الاول'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Third grade', 'ar'=> 'الصف الثالث'],
        ];

        foreach ($classrooms as $classroom) {
            RawRoom::create([
            'name' => $classroom,
            'grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }
}
