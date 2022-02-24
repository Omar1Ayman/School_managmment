<?php

use App\Grade;
use App\RawRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('raw_rooms')->delete();
        $class = [
            ['en' => 'First grade' , 'ar' => 'الصف الأول'],
            ['en' => 'Second grade' , 'ar' => 'الصف الثاني'],
            ['en' => 'Third grade' , 'ar' => 'الصف الثالث'],
            ['en' => 'Foutrh grade' , 'ar' => 'الصف الرابع'],
            ['en' => 'Fifth grade' , 'ar' => 'الصف الخامس'],
            ['en' => 'Sex grade' , 'ar' => 'الصف السادس'],
            ['en' => 'first middle grade' , 'ar' => 'الصف الأول الاعدادي'],
            ['en' => 'Second middle grade' , 'ar' => 'الصف الثاني الاعدادي'],
            ['en' => 'Third middle grade' , 'ar' => 'الصف الثالث الاعدادي'],
            ['en' => 'first high grade' , 'ar' => 'الصف الأول الثانوي'],
            ['en' => 'second high grade' , 'ar' => 'الصف الثاني الثانوي'],
            ['en' => 'third high grade' , 'ar' => 'الصف الثالث الثانوي'],
        ];


    }
}
