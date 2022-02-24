<?php

use App\Type_Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type__bloods')->delete();
        $bloods = ['A+' , 'A-' , 'O+' , 'O-' , 'B+' , 'B-' , 'AB+' , 'AB-'];
        foreach($bloods as $blood){
            Type_Blood::create([
                'name' => $blood
            ]);
        }

    }
}
