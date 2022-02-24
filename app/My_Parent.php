<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Model
{
    public $translatable = ['f_name' , 'f_job' , 'm_name' , 'm_job'];

    protected $guarded = [];

    use HasTranslations;

    public function nation(){
        return $this->belongsTo(Nationality::class);
    }
    public function religon(){
        return $this->belongsTo(Religon::class);
    }
    public function blood(){
        return $this->belongsTo(Type_Blood::class);
    }

    public function attachements(){
        return $this->hasMany(ParentAttachment::class , 'parent_id');
    }


    public function chidren(){
        return $this->hasMany(Student::class , 'parent_id');
    }
}


