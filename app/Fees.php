<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fees extends Model
{
    use HasTranslations;
    public $translatable = ['title'];
    protected $fillable=['title','amount','Grade_id','Classroom_id','Fee_type','year','description'];


    // علاقة بين الرسوم الدراسية والمراحل الدراسية لجب اسم المرحلة

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }


    // علاقة بين الصفوف الدراسية والرسوم الدراسية لجب اسم الصف

    public function classroom()
    {
        return $this->belongsTo(RawRoom::class, 'Classroom_id');
    }
}
