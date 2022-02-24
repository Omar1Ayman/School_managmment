<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class , 'student_id')->withDefault();
    }

    public function f_grade(){
        return $this->belongsTo(Grade::class , 'from_grade');
    }

    public function f_classroom(){
        return $this->belongsTo(RawRoom::class , 'from_class');
    }


    public function f_section(){
        return $this->belongsTo(Section::class , 'from_section');
    }

    public function t_grade(){
        return $this->belongsTo(Grade::class , 'to_grade');
    }

    public function t_classroom(){
        return $this->belongsTo(RawRoom::class , 'to_class');
    }

    public function t_section(){
        return $this->belongsTo(Section::class , 'to_section');
    }

}
