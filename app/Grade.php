<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Grade extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'notes'];

    public function raws(){
        return $this->hasMany(RawRoom::class , 'grade_id');
    }
    public function sections(){
        return $this->hasMany(Section::class , 'grade_id');
    }

    public function students(){
        return $this->hasMany(Student::class , 'Grade_id');
    }

     public function teachers(){
        return $this->hasMany(Teacher::class , 'grade_id');
    }

}

