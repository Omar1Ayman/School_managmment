<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Gender extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    public function gender_teachers(){
        return $this->hasMany(Teacher::class , 'gender_id');
    }


    public function gender_students(){
        return $this->hasMany(Student::class , 'gender_id');
    }
}
