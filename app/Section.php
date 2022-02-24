<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'state' ,  'grade_id' , 'class_id'];
    public function class(){
        return $this->belongsTo(RawRoom::class , 'class_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class , 'grade_id');
    }

    public function students(){
        return $this->hasMany(Student::class , 'section_id');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class , 'teacher_section');
    }
}
