<?php

use App\Grade;
use App\RawRoom;
use App\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $Sections = [
            ['en' => 'a', 'ar' => 'ا'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
        ];

        foreach ($Sections as $section) {
            Section::create([
                'name' => $section,
                'state' => 1,
                'grade_id' => Grade::all()->unique()->random()->id,
                'class_id' => RawRoom::all()->unique()->random()->id
            ]);
        }
    }
}
