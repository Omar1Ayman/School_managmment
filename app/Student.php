<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class Student extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['name'];

    protected $guarded = [];


    public function gender(){
        return $this->belongsTo(Gender::class , 'gender_id');
    }


    public function nation(){
        return $this->belongsTo(Nationality::class , 'nationalitie_id');
    }
    public function religon(){
        return $this->belongsTo(Religon::class);
    }
    public function blood(){
        return $this->belongsTo(Type_Blood::class);
    }

    public function grades(){
        return $this->belongsTo(Grade::class , 'Grade_id');
    }

    public function class(){
        return $this->belongsTo(RawRoom::class , 'Classroom_id');
    }

    public function section(){
        return $this->belongsTo(Section::class , 'section_id');
    }

    public function parent(){
        return $this->belongsTo(My_Parent::class , 'parent_id');
    }
    public function images(){
        return $this->morphMany('App\Image' , 'imageable');
    }

     // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');

    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');

    }





}
