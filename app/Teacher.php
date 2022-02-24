<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Teacher extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $guarded = [];

    public function gender(){
        return $this->belongsTo(Gender::class , 'gender_id');
    }

    public function grades(){
        return $this->belongsTo(Grade::class , 'grade_id');
    }

    public function specializations(){
        return $this->belongsTo(Specialization::class , 'spec_id');
    }

    public function sections(){
        return $this->belongsToMany(Section::class , 'teacher_section');
    }
}
