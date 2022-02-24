<?php

use App\Specialization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BloodSeeder::class);
         $this->call(NationalSeeder::class);
         $this->call(ReligonSeeder::class);
         $this->call(GenderSeeder::class);
         $this->call(SpecializationSeeder::class);
         $this->call(GradeSeeder::class);
         $this->call(AdminSeeder::class);
    }
}
