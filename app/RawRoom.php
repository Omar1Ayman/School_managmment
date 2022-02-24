<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RawRoom extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'grade_id'];
    public function grades(){
        return $this->belongsTo(Grade::class , 'grade_id');
    }

    public function sections(){
        return $this->hasMany(Section::class , 'class_id');
    }

    public function students(){
        return $this->hasMany(Student::class , 'Classroom_id');
    }
}
