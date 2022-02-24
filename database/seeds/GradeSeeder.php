<?php

use App\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();
        $grades = [
            ['en'=>'Primary Stage' , 'ar'=> 'المرحله الابتدائيه'],
            ['en'=>'Middle School' , 'ar'=> 'المرحله الاعداديه'],
            ['en'=>'High school' , 'ar'=> 'المرحله الثانويه'],
        ];

        foreach($grades as $g){
            Grade::create([
                'name' => $g,
                'notes' => "notes"
            ]);
        }
    }
}
