<?php

use App\Religon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religons')->delete();
        $religions = [

            [
                'en'=> 'Muslim',
                'ar'=> 'مسلم'
            ],
            [
                'en'=> 'Christian',
                'ar'=> 'مسيحي'
            ],
            [
                'en'=> 'Other',
                'ar'=> 'غيرذلك'
            ],
        ];
        foreach($religions as $r){
            Religon::create(['name'=>$r]);
        }
    }
}
